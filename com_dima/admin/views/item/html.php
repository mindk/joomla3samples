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
 * Item view class
 */
class DimaViewsItemHtml extends JViewHtml
{
	/**
	 * Default layout preparations
	 */
	protected function _default()
	{
		$this->item = $this->model->getItem();
		$this->form = $this->model->getForm();

		JToolbarHelper::title(JText::_('COM_DIMA') . ' : ' . JText::_('COM_DIM_EDIT_ITEM') . ' [' . ($this->item->name ? $this->item->name : JText::_('COM_DIMA_NEW_ITEM')) . ']', '');

		JToolbarHelper::apply();
		JToolbarHelper::save();
		JToolbarHelper::cancel();
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