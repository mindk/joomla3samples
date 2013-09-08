<?php
/**
 * MaximModelsDefault class file. Abstract class for all models
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');


/**
 * Abstract class for all models
 *
 * @package com_maxim
 * @author  Maxim
 */
abstract class MaximModelsDefault extends JModelBase
{

	/**
	 * Total count in list
	 *
	 * @var null|int
	 */
	protected $total = null;

	/**
	 * Storage for database driver
	 *
	 * @var JDatabaseDriver|null
	 */
	protected $db = null;

	/**
	 * Storage for table
	 *
	 * @var null|JTable
	 */
	protected $table = null;

	/**
	 * Path for form xml definitions
	 *
	 * @var string
	 */
	protected $form_path = 'forms';

	/**
	 * Storage for edit form
	 *
	 * @var null|JForm
	 */
	protected $form = null;

	/**
	 * Storage for loaded item
	 *
	 * @var null|JTable
	 */
	protected $item = null;

	/**
	 * Instantiate the model.
	 *
	 * @param   JRegistry $state  The model state.
	 *
	 * @return MaximModelsDefault
	 */
	public function __construct(JRegistry $state = null)
	{
		parent::__construct($state);

		$this->db = JFactory::getDBO();
		$table_class = $this->getTableName();
		$this->table = new $table_class($this->db);
	}

	/**
	 * Return table name
	 *
	 * @return string table name
	 */
	protected function getTableName()
	{
		return 'MaximTables' . array_pop(explode('_', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', get_class($this))));
	}

	/**
	 * Build List Selecting Query
	 *
	 * @return string SQL
	 */
	protected function buildQuery()
	{
		$query = $this->db->getQuery(true);

		$query->select('tbl.*')->from($this->table->getTableName() . ' AS tbl');

		return $query;
	}

	/**
	 * Returns filtered list of item records
	 *
	 * @return array list of item records
	 */
	public function getList()
	{
		$offset = (int) $this->state->get('limitstart', 0);
		$limit = (int) $this->state->get('limit', 0);
		$orderCol = $this->db->escape($this->state->get('list.ordering', 'id'));
		$orderDirn = $this->db->escape($this->state->get('list.direction', 'ASC'));

		$query = $this->buildQuery();
		$query->order('tbl.' . $orderCol . ' ' . $orderDirn);

		$result = $this->db
			->setQuery($query, $offset, $limit)
			->loadObjectList();

		return $result;
	}

	/**
	 * Returns total item count
	 *
	 * @return int total item count
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
	 * Returns item
	 *
	 * @return JTable item
	 */
	public function getItem()
	{
		if (is_null($this->item))
		{
			$this->table->load($this->state->get('id', 0));
			$this->item = $this->table;
		}

		return $this->item;
	}

	/**
	 * Returns pagination
	 *
	 * @return JPagination pagination
	 */
	public function getPagination()
	{
		return new JPagination($this->getTotal(), $this->state->get('limitstart', 0), $this->state->get('limit', 0));
	}

	/**
	 * Returns form for item edit
	 *
	 * @return JForm form for item edit
	 */
	public function getForm()
	{

		if (is_null($this->form))
		{
			$inflector = JStringInflector::getInstance();

			$form_name = array_pop(explode('_', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', get_class($this))));
			$form_name = $inflector->toSingular(strtolower($form_name));

			$this->form = JForm::getInstance($form_name, __DIR__ . '/' . $this->form_path . '/' . $form_name . '.xml', array('control' => 'jform'));
			$this->form->bind($this->getItem());
		}

		return $this->form;
	}
}