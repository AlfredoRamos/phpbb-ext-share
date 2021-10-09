<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\tests\functional;

use Symfony\Component\DomCrawler\Crawler;

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

		$table = $crawler->filter('#share-social-network-list');
		$this->assertSame(1, $table->count());

		$networks = $table->filter('.share-item');
		$this->assertSame(16, $networks->count());

		$preview = $crawler->filter('.share-preview');
		$this->assertSame(1, $preview->count());

		$list = $preview->filter('.share-list');
		$this->assertSame(1, $list->count());

		$networks = $list->filter('.share-item');
		$this->assertSame(16, $networks->count());

		foreach ($networks as $network)
		{
			$network = new Crawler($network);

			$this->assertFalse(empty($network->attr('data-network')));
			$this->assertSame(1, preg_match('#^[\w\-]+$#', $network->attr('data-network')));

			$icon = $network->filter('.share-icon');
			$this->assertSame(1, $icon->count());
			$this->assertFalse(empty($icon->attr('data-icon')));
			$this->assertSame(1, preg_match('#^[\w\-]+:[\w\-]+$#', $icon->attr('data-icon')));
		}
	}
}
