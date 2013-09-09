<?php
/**
 * Students table class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Class for students table
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoTablesStudents extends JTable
{
	/**
	 * Students table constructor
	 *
	 * @param object $db database connection instance
	 *
	 * @return VpetrenkoTablesStudents
	 */
	function __construct($db)
	{
		parent::__construct('#__vpetrenko_students', 'id', $db);
	}
}