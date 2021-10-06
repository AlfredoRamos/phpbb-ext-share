<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use alfredoramos\share\includes\helper;

class listener implements EventSubscriberInterface
{
	protected $helper;

	public function __construct(helper $helper)
	{
		$this->helper = $helper;
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'user_setup',
			'core.viewtopic_modify_post_row' => 'post_row',
			'core.viewtopic_post_row_after' => 'post_template'
		];
	}

	public function user_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = [
			'ext_name'	=> 'alfredoramos/share',
			'lang_set'	=> 'common'
		];
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function post_row($event)
	{
		$event['post_row'] = $this->helper->add_post_row_data($event['post_row']);
	}

	public function post_template($event)
	{
		$this->helper->assign_post_template_vars(
			(int) $event['post_row']['POST_ID'],
			(string) $event['post_row']['POST_SUBJECT'],
			(bool) $event['post_row']['S_FIRST_POST'],
			(int) $event['row']['topic_id']
		);
	}
}
