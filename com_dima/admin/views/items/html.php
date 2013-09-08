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
 * Items view class
 */
class DimaViewsItemsHtml extends JViewHtml
{
	/**
	 * Default layout preparations
	 */
	protected function _default()
	{
		$this->list = $this->model->getList();
		$this->pagination = $this->model->getPagination();
		$this->state = $this->model->getState();

		JToolbarHelper::title(JText::_('COM_DIMA'), '');
		JToolbarHelper::addNew('read');
		JToolbarHelper::editList('read');
		JToolbarHelper::deleteList();
	}

	/**
	 * View render method
	 *
	 * @return mixed
	 */
	function render()
	{
		//retrieve task list from model
		$method = '_' . $this->getLayout();

		if (method_exists($this, $method))
			$this->$method();
		else
			$this->_default();

		//display
		return parent::render();
	}
}