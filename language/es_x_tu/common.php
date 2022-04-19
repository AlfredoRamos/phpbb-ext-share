<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

/**
 * @ignore
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
 * @ignore
 */
if (empty($lang) || !is_array($lang))
{
	$lang = [];
}

$lang = array_merge($lang, [
	'SHARE_WHATSAPP' => 'WhatsApp',
	'SHARE_WHATSAPP_WEB' => 'WhatsApp (Web)',
	'SHARE_TELEGRAM' => 'Telegram',
	'SHARE_FACEBOOK' => 'Facebook',
	'SHARE_TWITTER' => 'Twitter',
	'SHARE_REDDIT' => 'Reddit',
	'SHARE_VK' => 'Vk',
	'SHARE_TUMBLR' => 'Tumblr',
	'SHARE_EVERNOTE' => 'Evernote',
	'SHARE_POCKET' => 'Pocket',
	'SHARE_DIGG' => 'Digg',
	'SHARE_DIIGO' => 'Diigo',
	'SHARE_LINKEDIN' => 'LinedIn',
	'SHARE_SKYPE' => 'Skype',
	'SHARE_PINTEREST' => 'Pinterest',
	'SHARE_EMAIL' => 'Email',
	'SHARE_SMS' => 'SMS'
]);
