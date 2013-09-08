<?php
/**
 * Animals table class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Animals table class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximTablesAnimals extends JTable
{
	public function __construct($db)
	{
		parent::__construct('#__maxim_animals', 'id', $db);
	}
}