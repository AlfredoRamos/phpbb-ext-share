<?php

/**
 * Share Links extension for phpBB.
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2020 Alfredo Ramos
 * @license GPL-2.0-only
 */

namespace alfredoramos\share\tests\functional;

trait functional_test_case_trait
{
	static protected function setup_extensions()
	{
		return ['alfredoramos/share'];
	}
}
