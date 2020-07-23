<?php

/**
 * Share Buttons extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\includes;

class helper
{
	protected $config;
	protected $template;
	protected $language;
	protected $controller_helper;

	public function __construct()
	{
		global $config, $template, $phpbb_container;

		$this->config = $config;
		$this->template = $template;
		$this->language = $phpbb_container->get('language');
		$this->controller_helper = $phpbb_container->get('controller.helper');
	}

	public function share_buttons($title = '')
	{
		$title = trim($title);

		if (empty($title))
		{
			return;
		}

		$allowed = $this->social_networks();
		$enabled = $this->enabled_social_networks();
		$data = [
			$this->clean_url($this->controller_helper->get_current_url(), true),
			utf8_htmlspecialchars($title)
		];

		foreach ($enabled as $network)
		{
			if (empty($allowed[$network]['url']) || empty($allowed[$network]['icon']))
			{
				return;
			}

			$this->template->assign_block_vars('SHARE_SOCIAL_NETWORKS', [
				'KEY' => $network,
				'URL' => $this->clean_url(vsprintf($allowed[$network]['url'], $data)),
				'ICON' => $allowed[$network]['icon'],
				'LANG' => sprintf('SHARE_%s', strtoupper(str_replace('-', '_', $network))),
				'NEWTAB' => !empty($allowed[$network]['newtab'])
			]);
		}
	}

	/**
	 * Clean URL to be used as HTML attribute value.
	 *
	 * @param string	$url
	 * @param bool		$encode
	 *
	 * @return string
	 */
	public function clean_url($url = '', $encode = false)
	{
		$url = trim($url);

		if (empty($url))
		{
			return '';
		}

		// Remove app.php/ from URL
		if ((int) $this->config['enable_mod_rewrite'] === 1)
		{
			$url = preg_replace('#app\.' . $this->php_ext . '/(.+)$#', '\1', $url);
		}

		// Escape ampersand
		$url = htmlspecialchars($url, ENT_COMPAT, 'UTF-8', false);

		// Remove SID from URL
		$url = str_replace($this->user->session_id, '', $url);
		$url = preg_replace('#(?:&|\?)?sid=#', '', $url);
		$url = str_replace('?&', '?', $url);

		// Remove index.php without parameters
		$url = preg_replace('#index\.' . $this->php_ext . '$#', '', $url);

		// Encode URL
		if (!empty($encode))
		{
			$url = str_replace('&amp;', '&', $url);
			$url = urlencode($url);
		}

		// Return URL
		return $url;
	}

	/**
	 * Remove empty items from an array, recursively.
	 *
	 * @param array		$data
	 * @param integer	$max_depth
	 * @param integer	$depth
	 *
	 * @return array
	 */
	public function filter_empty_items($data = [], $max_depth = 5, $depth = 0)
	{
		if (empty($data))
		{
			return [];
		}

		// Cast values
		$max_depth = abs($max_depth);
		$max_depth = !empty($max_depth) ? $max_depth : 5;
		$depth = abs($depth) + 1;

		// Do not go deeper, return data as is
		if ($depth > $max_depth)
		{
			return $data;
		}

		// Remove empty elements
		foreach ($data as $key => $value)
		{
			if (empty($value))
			{
				unset($data[$key]);
			}

			if (!empty($data[$key]) && is_array($data[$key]))
			{
				$data[$key] = $this->filter_empty_items($data[$key], $max_depth, $depth);
			}
		}

		// Return a copy
		return $data;
	}

	public function enabled_social_networks()
	{
		// Helper
		$enabled = explode(',', trim($this->config['share_social_networks']));
		$enabled = $this->filter_empty_items($enabled);

		// Fallback to allowed values
		if (empty($enabled))
		{
			$enabled = $this->social_networks();
			$enabled = array_keys($enabled);
		}

		return $enabled;
	}

	public function social_networks($key = '')
	{
		// %1$s => URL
		// %2$s => Text
		$social_networks = [
			'whatsapp'		=> [
				'url'	=> 'https://wa.me/?text=%2$s %1$s',
				'icon'	=> 'dashicons:whatsapp'
			],
			'whatsapp-web'	=> [
				'url'	=> 'https://web.whatsapp.com/send?text=%2$s %1$s',
				'icon'	=> 'dashicons:whatsapp'
			],
			'telegram'		=> [
				'url'	=> 'https://telegram.me/share/url?text=%2$s&url=%1$s',
				'icon'	=> 'cib:telegram-plane'
			],
			'facebook'		=> [
				'url'	=> 'https://www.facebook.com/sharer/sharer.php?t=%2$s&u=%1$s',
				'icon'	=> 'brandico:facebook'
			],
			'twitter'		=> [
				'url'	=> 'https://twitter.com/intent/tweet?text=%2$s&url=%1$s',
				'icon'	=> 'cib:twitter'
			],
			'reddit'		=> [
				'url'	=> 'https://www.reddit.com/submit?title=%2$s&url=%1$s',
				'icon'	=> 'fa-brands:reddit-alien'
			],
			'vk'			=> [
				'url'	=> 'https://vk.com/share.php?title=%2$s&url=%1$s',
				'icon'	=> 'entypo-social:vk'
			],
			'tumblr'		=> [
				'url'	=> 'https://www.tumblr.com/share/link?name=%2$s&url=%1$s',
				'icon'	=> 'brandico:tumblr'
			],
			'evernote'		=> [
				'url'	=> 'https://www.evernote.com/clip.action?title=%2$s&url=%1$s',
				'icon'	=> 'cib:evernote'
			],
			'pocket'		=> [
				'url'	=> 'https://getpocket.com/save?title=%2$s&url=%1$s',
				'icon'	=> 'cib:pocket'
			],
			'digg'			=> [
				'url'	=> 'https://digg.com/submit?bodytext=%2$s&url=%1$s',
				'icon'	=> 'cib:digg'
			],
			'diigo'			=> [
				'url'	=> 'https://www.diigo.com/post?title=%2$s&url=%1$s',
				'icon'	=> 'brandico:diigo'
			],
			'linkedin'			=> [
				'url'	=> 'https://www.linkedin.com/sharing/share-offsite/?url=%1$s',
				'icon'	=> 'brandico:linkedin'
			],
			'skype'			=> [
				'url'	=> 'https://web.skype.com/share?text=%2$s&url=%1$s',
				'icon'	=> 'cib:skype'
			],
			'email'			=> [
				'url'	=> 'mailto:?subject=%2$s&body=%1$s',
				'icon'	=> 'dashicons:email-alt'
			],
			'sms'			=> [
				'url'	=> 'sms:?body=%2$s %1$s',
				'icon'	=> 'mdi:cellphone-message'
			]
		];

		// Do not open in a new tab
		$exclude_newtab = [
			'whatsapp',
			'telegram',
			'email',
			'sms'
		];

		// Set new tab option
		foreach ($social_networks as $network => $values)
		{
			if (array_key_exists('newtab', $values))
			{
				continue;
			}

			$social_networks[$network]['newtab'] = !in_array($network, $exclude_newtab, true);
		}

		$key = trim($key);

		// Return URL format
		if (!empty($key))
		{
			if (empty($social_networks[$key]))
			{
				return '';
			}

			return $social_networks[$key];
		}

		// Return whole array
		return $social_networks;
	}
}
