<?php

/**
 * Share Buttons extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\controller;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\request\request;
use phpbb\language\language;
use phpbb\user;
use phpbb\log\log;
use alfredoramos\share\includes\helper;

class acp
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \alfredoramos\share\includes\helper */
	protected $helper;

	/**
	 * Controller constructor.
	 *
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\template\template				$template
	 * @param \phpbb\request\request				$request
	 * @param \phpbb\language\language				$language
	 * @param \phpbb\user							$user
	 * @param \phpbb\log\log						$log
	 * @param \alfredoramos\share\includes\helper	$helper
	 *
	 * @return void
	 */
	public function __construct(config $config, template $template, request $request, language $language, user $user, log $log, helper $helper)
	{
		$this->config = $config;
		$this->template = $template;
		$this->request = $request;
		$this->language = $language;
		$this->user = $user;
		$this->log = $log;
		$this->helper = $helper;
	}

	/**
	 * Settings mode page.
	 *
	 * @param string $u_action
	 *
	 * @return void
	 */
	public function settings_mode($u_action = '')
	{
		if (empty($u_action))
		{
			return;
		}

		// Allowed values
		$allowed = $this->helper->social_networks();

		// Enabled values
		$enabled = $this->helper->enabled_social_networks();

		// Validation errors
		$errors = [];

		// Request form data
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('alfredoramos_share'))
			{
				trigger_error(
					$this->language->lang('FORM_INVALID') .
					adm_back_link($u_action),
					E_USER_WARNING
				);
			}

			// Form data
			$fields = [
				'share_social_networks' => $this->helper->filter_empty_items(
					$this->request->variable('share_social_networks', [0 => ''])
				),
				'share_social_networks_order' => $this->helper->filter_empty_items(
					explode(',', $this->request->variable('share_social_networks_order', ''))
				)
			];

			// Validation check
			if (!empty($fields['share_social_networks']))
			{
				// Data helpers
				$field = 'share_social_networks';
				$diff = array_diff($fields[$field], array_keys($allowed));
				$ordered = array_diff($fields[sprintf('%s_order', $field)], $fields[$field]);

				// Enabled (input) values must be in the allowed values
				if (!empty($diff) || !empty($ordered))
				{
					$values = array_merge($diff, $ordered);
					$errors[]['message'] = $this->language->lang(
						'ACP_SHARE_VALIDATE_VALUES_NOT_ALLOWED',
						$this->language->lang('ACP_' . strtoupper($field)),
						implode(',', $values)
					);
				}
				else
				{
					// Convert enabled values (array) to string
					if (is_array($fields[$field]))
					{
						$fields[$field] = implode(',', $fields[$field]);
					}

					// Ordered networks must match the ones enabled
					// Use the ordered values
					if (empty($ordered))
					{
						$fields[$field] = $fields[sprintf('%s_order', $field)];
					}

					// Save configuration
					$this->config->set($field, $fields[$field]);

					// Admin log
					$this->log->add(
						'admin',
						$this->user->data['user_id'],
						$this->user->ip,
						'LOG_SHARE_DATA',
						false,
						[$this->language->lang('SETTINGS')]
					);

					// Confirm dialog
					trigger_error(
						$this->language->lang('CONFIG_UPDATED') .
						adm_back_link($u_action)
					);
				}
			}
		}

		// Assign allowed values
		foreach ($allowed as $key => $value)
		{
			if (empty($value['url']) || empty($value['icon']))
			{
				return;
			}

			$this->template->assign_block_vars('SHARE_SOCIAL_NETWORKS', [
				'KEY' => $key,
				'ICON' => $value['icon'],
				'LANG' => sprintf('SHARE_%s', strtoupper(str_replace('-', '_', $key))),
				'ENABLED' => in_array($key, $enabled, true)
			]);
		}

		// Assign validation errors
		foreach ($errors as $error)
		{
			$this->template->assign_block_vars('VALIDATION_ERRORS', [
				'MESSAGE' => $error['message']
			]);
		}
	}
}
