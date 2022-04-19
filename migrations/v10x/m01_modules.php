<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\migrations\v10x;

use phpbb\db\migration\migration;

class m01_modules extends migration
{
	/**
	 * Add ACP modules.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'module.add',
				[
					'acp',
					'ACP_CAT_DOT_MODS',
					'ACP_SHARE'
				]
			],
			[
				'module.add',
				[
					'acp',
					'ACP_SHARE',
					[
						'module_basename' => '\alfredoramos\share\acp\main_module',
						'modes' => ['settings']
					]
				]
			]
		];
	}
}
