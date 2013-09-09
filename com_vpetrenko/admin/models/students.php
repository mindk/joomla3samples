<?php
/**
 * Student mpdel class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Students model class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoModelsStudents extends VpetrenkoModelsDefault
{

	/**
	 * Store data
	 *
	 * @return JTable object
	 */
	public function store()
	{
		return parent::store($this->data);
	}

	/**
	 * Validate data before store
	 *
	 * @return bool if data is valid and false - if not
	 */
	public function validate()
	{
		$params = $this->getState();

		if (!$this->data['firstname'] || !$this->data['lastname'])
		{
			$params->set('error', 1);
			$this->setState($params);

			return false;
		}
		$params->set('error', null);
		$this->setState($params);

		return true;
	}
}