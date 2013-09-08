<?php
/**
 * Animal list html view class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Animal list html view class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximViewsAnimalsHtml extends JViewHtml
{
	/**
	 * Method to render the view.
	 *
	 * @return  string  The rendered view.
	 */
	function render()
	{
		$model = $this->model;
		$this->items = $model->getList();
		$this->state = $model->getState();
		$this->pagination = $model->getPagination();

		JToolbarHelper::addNew('new');

		return parent::render();
	}

	/**
	 * Returns an array of fields the table can be sorted by
	 *
	 * @return  array  Array containing the field name to sort by as the key and display text as value
	 */
	protected function getSortFields()
	{
		return array(
			'speed' => JText::_('COM_MAXIM_HEADING_SPEED'),
			'height' => JText::_('COM_MAXIM_HEADING_HEIGHT'),
			'weight' => JText::_('COM_MAXIM_HEADING_WEIGHT'),
			'name' => JText::_('COM_MAXIM_HEADING_NAME'),
			'published' => JText::_('JSTATUS'),
			'id' => JText::_('JGRID_HEADING_ID')
		);
	}
}