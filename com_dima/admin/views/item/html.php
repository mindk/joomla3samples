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
 * Item view class
 *
 * @package     com_dima
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