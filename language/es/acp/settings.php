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
	'ACP_SHARE_SETTINGS' => 'Ajustes de Share Links',
	'ACP_SHARE_SETTINGS_EXPLAIN' => 'Aqui puede elegir qué redes sociales desea mostrar al compartir mensajes.',
	'ACP_SHARE_SETTINGS_WARNING' => 'Tiene cambios sin guardar, si abandona esta página los cambios realizados se perderán.',
	'ACP_SHARE_TYPE' => 'Tipo',
	'ACP_SHARE_TYPE_EXPLAIN' => 'El tipo determina el lugar en donde se mostrarán los enlaces para compartir en redes sociales.',
	'ACP_SHARE_TOPIC' => 'Tema',
	'ACP_SHARE_POST' => 'Mensaje',
	'ACP_SHARE_SOCIAL_NETWORKS' => 'Redes Sociales',
	'ACP_SHARE_PREVIEW_EXPLAIN' => 'Arrastre y suelte los iconos para cambiar el orden de las redes sociales.',
	'ACP_SHARE_VALIDATE_VALUES_NOT_ALLOWED' => 'Los valores proporcionados para <samp>%1$s</samp> no estan permitidos: <code>%2$s</code>'
]);
