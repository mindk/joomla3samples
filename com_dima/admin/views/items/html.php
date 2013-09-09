<?php
/**
 * @package     com_dima
 *
 * @author      Davidov D.
 * @copyright   Copyright (C) 2013 Mindk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Items view class
 *
 * @package     com_dima
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
	 * @return string
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