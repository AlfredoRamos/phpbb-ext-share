<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\tests\functional;

/**
 * @group functional
 */
class acp_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/share'];
	}

	protected function setUp(): void
	{
		parent::setUp();
		$this->login();
		$this->admin_login();
	}

	public function test_settings_page()
	{
		$crawler = self::request('GET', sprintf(
			'adm/index.php?i=-alfredoramos-share-acp-main_module&mode=settings&sid=%s',
			$this->sid
		));

		$form = $crawler->selectButton('submit')->form();

		$this->assertTrue($form->has('share_type'));
		$this->assertContains('topic', $form->get('share_type')->availableOptionValues());
		$this->assertContains('post', $form->get('share_type')->availableOptionValues());
	}
}
