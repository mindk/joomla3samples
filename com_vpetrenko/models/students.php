<?php // no direct access

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
	 * Build query for get list
	 *
	 * @return string SQL query
	 */
	public function _buildQuery()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select('*')
			->from('#__vpetrenko_students');

		return $query;
	}

	/**
	 * Build where condition
	 *
	 * @param $query SQL query
	 *
	 * @return string SQL query
	 */
	protected function _buildWhere($query)
	{
		$query->where('published = 1');
		return $query;
	}

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