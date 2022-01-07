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
class topic_test extends \phpbb_functional_test_case
{
	use functional_test_case_trait;

	public function test_topic_share_links()
	{
		$crawler = self::request('GET', sprintf(
			'viewtopic.php?t=1&sid=%s',
			$this->sid
		));

		$post = $crawler->filter('#post_content1');
		$this->assertSame(1, $post->count());

		$list = $post->filter('.share-list');
		$this->assertSame(1, $list->count());

		$networks = $list->filter('.share-item');
		$this->assertSame(17, $networks->count());

		foreach ($networks as $network)
		{
			$network = new Crawler($network);

			$this->assertSame(1, preg_match('#share\-link\-[\w\-]+#', $network->attr('class')));
			$this->assertSame(1, preg_match('#^(?:https|mailto|sms):#', $network->attr('href')));
			$this->assertSame('external nofollow noreferrer noopener', $network->attr('rel'));
			$this->assertFalse(empty($network->attr('title')));

			$icon = $network->filter('.share-icon');
			$this->assertSame(1, $icon->count());
			$this->assertFalse(empty($icon->attr('data-icon')));
			$this->assertSame(1, preg_match('#^[\w\-]+:[\w\-]+$#', $icon->attr('data-icon')));
		}
	}
}
