<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\acp;

class main_info
{
	/**
	 * Setup ACP module.
	 *
	 * @return array
	 */
	public function module()
	{
		return [
			'filename'	=> '\alfredoramos\share\acp\main_module',
			'title'		=> 'ACP_SHARE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'SETTINGS',
					'auth'	=> 'ext_alfredoramos/share && acl_a_board',
					'cat'	=> ['ACP_SHARE']
				]
			]
		];
	}
}
