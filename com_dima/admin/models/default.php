<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_dima
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Default abstract model
 */
abstract class DimaModelsDefault extends JModelBase
{
	/**
	 * @var null Total count
	 */
	protected $total = null;

	/**
	 * @var null Pagination object
	 */
	protected $pagination = null;

	/**
	 * @var JDatabaseDriver|null  DB object
	 */
	protected $db = null;

	/**
	 * @var null Table
	 */
	protected $table = null;

	/**
	 * @var string Relative path to form files
	 */
	protected $form_path = 'forms';

	/**
	 * @var null Form object
	 */
	protected $form = null;

	/**
	 * @var null Active item object
	 */
	protected $item = null;

	/**
	 * Item Model Class constructor
	 */
	public function __construct(JRegistry $state = null)
	{
		parent::__construct($state);

		$this->db = JFactory::getDBO();
		$table_class = $this->getTableClassName();
		$this->table = new $table_class($this->db);
	}

	/**
	 * Get table class name
	 *
	 * @return string table name
	 */
	protected function getTableClassName()
	{
		return str_replace('Models', 'Tables', get_class($this));
	}

	/**
	 * Build List Selecting Query
	 *
	 * @return string SQL
	 */
	protected function buildQuery()
	{
		$query = $this->db->getQuery(true);

		$query->select('*')->from($this->table->getTableName());

		return $query;
	}

	/**
	 * Delete records(s)
	 *
	 * @return bool
	 */
	public function delete()
	{
		$cid = $this->state->get('cid', array());
		$success = false;
		$errors = 0;

		if (!empty($cid))
		{
			foreach ($cid as $id)
				$errors += $this->table->delete($id) ? 0 : 1;

			$success = !$errors;
		}

		return $success;
	}

	/**
	 * Get filtered list of records
	 *
	 * @return array
	 */
	public function getList()
	{
		$offset = (int) $this->state->get('limitstart', 0);
		$limit = (int) $this->state->get('limit', 0);
		$orderCol = $this->db->escape($this->state->get('list.ordering', 'id'));
		$orderDirn = $this->db->escape($this->state->get('list.direction', 'ASC'));

		$query = $this->buildQuery();
		$query->order($orderCol . ' ' . $orderDirn);

		$result = $this->db
			->setQuery($query, $offset, $limit)
			->loadObjectList();

		return $result;
	}

	/**
	 * Get total item count
	 *
	 * @return int
	 */
	public function getTotal()
	{

		if (is_null($this->total))
		{
			$query = $this->buildQuery();
			$items = $this->db
				->setQuery($query)
				->loadObjectList();
			$this->total = count($items);
		}
		return $this->total;
	}

	/**
	 * Get form object
	 *
	 * @return object
	 */
	public function getForm()
	{
		if (empty($this->form))
		{
			$inflector = JStringInflector::getInstance();

			$form_name = array_pop(explode('_', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', get_class($this))));
			$form_name = $inflector->toSingular($form_name);

			$form = JForm::getInstance($form_name, __DIR__ . '/' . $this->form_path . '/' . $form_name . '.xml', array('control' => 'jform'));
			$form->bind($this->getItem());
			$this->form = $form;
		}

		return $this->form;
	}

	/**
	 * Get item
	 *
	 * @return null
	 */
	public function getItem()
	{
		if (empty($this->item))
		{
			$this->table->load($this->state->get('id', 0));
			$this->item = $this->table;
		}
		return $this->item;
	}

	/**
	 * Get pagination object
	 *
	 * @return JPagination
	 */
	public function getPagination()
	{
		return new JPagination($this->getTotal(), $this->state->get('limitstart', 0), $this->state->get('limit', 0));
	}
}