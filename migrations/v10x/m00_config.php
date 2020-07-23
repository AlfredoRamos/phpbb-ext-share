<?php

/**
 * Share Buttons extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\migrations\v10x;

use phpbb\db\migration\migration;

class m00_config extends migration
{
	/**
	 * Add social networks.
	 *
	 * @return array
	 */
	public function update_data()
	{
		return [
			[
				'config.add',
				['share_social_networks', '']
			]
		];
	}
}
