<?php
/**
 * Students list template
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Students view class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoViewsStudentsHtml extends JViewHtml
{
	/**
	 * Render the page
	 *
	 * @return void
	 */
	function render()
	{
		$model = $this->model;
		$this->items = $model->getList();
		$this->state = $model->getState();
		$this->pagination = $model->getPagination();

		$this->addToolbar();
		return parent::render();
	}

	/**
	 * Add the page title and toolbar
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('com_vpetrenko_TITLE_PAGES'));

		//Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/views/student';

		if (file_exists($formPath))
		{
			JToolBarHelper::addNew('new');
		}
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
			'firstname' => JText::_('com_vpetrenko_FIRSTNAME'),
			'lastname' => JText::_('com_vpetrenko_LASTNAME'),
			'group' => JText::_('com_vpetrenko_GROUP'),
			'address' => JText::_('com_vpetrenko_ADDRESS'),
			'hobby' => JText::_('com_vpetrenko_HOBBY'),
			'published' => JText::_('com_vpetrenko_PUBLISHED'),
			'id' => JText::_('com_vpetrenko_ID')
		);
	}

}