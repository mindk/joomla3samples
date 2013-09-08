<?php
/**
 * Animals model class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Animals model class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximModelsAnimals extends MaximModelsDefault
{
	/**
	 * Returns query for select items
	 *
	 * @return JDatabaseQuery query object
	 */
	protected function buildQuery()
	{
		$query = parent::buildQuery();

		$query->select('uc.name AS editor')
			->join('LEFT', '#__users AS uc ON uc.id=tbl.checked_out');

		return $query;
	}
}