<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Base abstract component model
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
abstract class VpetrenkoModelsDefault extends JModelBase
{
	/**
	 * @var int count list records
	 */
	protected $total = null;

	/**
	 * @var object pagination
	 */
	protected $pagination = null;

	/**
	 * @var JDatabaseDriver instance of database connection
	 */
	protected $db = null;

	/**
	 * @var JTable instance of table class
	 */
	protected $table = null;

	/**
	 * @var array data
	 */
	protected $data = null;

	/**
	 * @var string path to xml form settings
	 */
	protected $form_path = 'forms';

	/**
	 * @var object item
	 */
	protected $item = null;

	/**
	 * Constructor for model
	 *
	 * @param JRegistry $state object of states
	 */
	public function __construct(JRegistry $state = null)
	{
		parent::__construct($state);

		$this->db = JFactory::getDBO();
		$table_class = $this->getTableName();
		$this->table = new $table_class($this->db);
	}

	/**
	 * Get table name based on model class name
	 *
	 * @return string table name
	 */
	protected function getTableName()
	{
		return 'VpetrenkoTables' . array_pop(explode('_', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', get_class($this))));
	}

	/**
	 * Build get list query
	 *
	 * @return string SQL query
	 */
	protected function buildQuery()
	{
		$query = $this->db->getQuery(true);

		$query->select('*')->from($this->table->getTableName());

		return $query;
	}

	/**
	 * Get item
	 *
	 * @return object entity item
	 */
	public function getItem()
	{
		if (!$this->item)
		{
			$this->table->load($this->getState()->get('id', 0));
			$this->item = $this->table;

			return $this->table;
		}

		return $this->item;
	}


	/**
	 * Get filtered list of item records
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
		$query->order($this->db->quoteName($orderCol) . ' ' . $orderDirn);

		$result = $this->db
			->setQuery($query, $offset, $limit)
			->loadObjectList();

		return $result;
	}

	/**
	 * Get total number of rows for pagination
	 *
	 * @return int rows number
	 */
	function getTotal()
	{
		if (empty ($this->total))
		{
			$query = $this->_buildQuery();
			$this->db->setQuery($query);
			$this->db->execute();

			return $this->db->getNumRows();
		}

		return $this->total;
	}

	/**
	 * Store data
	 *
	 * @param array $data data to store
	 *
	 * @return JTable instance
	 */
	public function store($data = null)
	{
		$this->table->save($data);

		return $this->table;
	}

	/**
	 * Generate pagination
	 *
	 * @return JPagination object
	 */
	public function getPagination()
	{
		return new JPagination($this->getTotal(), $this->state->get('limitstart', 0), $this->state->get('limit', 0));
	}

	/**
	 * Set data to model
	 *
	 * @param array data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}

	/**
	 * Get model data
	 *
	 * @return array data
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Get form
	 *
	 * @return JForm object get form object
	 */
	public function getForm()
	{
		$inflector = JStringInflector::getInstance(true);

		$form_name = array_pop(explode('_', preg_replace('/(?<=\\w)([A-Z])/', '_\\1', get_class($this))));
		$form_name = strtolower($inflector->toSingular($form_name));
		$form = JForm::getInstance($form_name, __DIR__ . '/' . $this->form_path . '/' . $form_name . '.xml', array('control' => 'jform'));

		return $form;
	}
}