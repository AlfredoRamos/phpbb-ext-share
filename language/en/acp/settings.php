<?php

/**
 * Share Buttons extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
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
	'ACP_SHARE_SETTINGS' => 'Share Buttons settings',
	'ACP_SHARE_SETTINGS_EXPLAIN' => 'Here you can choose and sort social networks you want to show share buttons for.',
	'ACP_SHARE_SETTINGS_WARNING' => 'You have unsaved changes, if you leave this page your current changes will be lost.',
	'ACP_SHARE_SOCIAL_NETWORKS' => 'Social Networks',
	'ACP_SHARE_VALIDATE_VALUES_NOT_ALLOWED' => 'The values given for <samp>%1$s</samp> are not allowed: <code>%2$s</code>'
]);
