<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	protected $helper;

	public function __construct()
	{
		global $phpbb_container;

		$this->helper = $phpbb_container->get('alfredoramos.share.helper');
	}

	static public function getSubscribedEvents()
	{
		return [
			'core.user_setup' => 'user_setup',
			'core.viewtopic_modify_page_title' => 'viewtopic'
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

	public function viewtopic($event)
	{
		$title = $event['topic_data']['topic_title'];

		if (empty($title))
		{
			return;
		}
		
		$this->helper->share_buttons($title);
	}
}
