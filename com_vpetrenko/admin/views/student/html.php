<?php
/**
 * Student list view class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Student view class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoViewsStudentHtml extends JViewHtml
{
	/**
	 * Render the page
	 *
	 * @return string
	 */
	function render()
	{
		$model = $this->model;
		$error = $this->model->getState()->get('error');
		if ($this->model->getState()->get('id') && !$error)
		{
			$this->item = $model->getItem();
		}
		else
		{
			$this->item = $this->model->getData();
		}

		$this->task = JFactory::getApplication()->input->get('task');

		$this->addToolbar();

		$this->form = $this->model->getForm();
		$this->form->bind($this->item);

		return parent::render();
	}

	/**
	 * Add the page title and toolbar
	 *
	 * @return void
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		JToolBarHelper::title(JText::_('COM_VPETRENKO_TITLE_PAGES'));

		JToolBarHelper::apply();
		JToolBarHelper::save();

		if (empty($this->item->id))
		{
			JToolBarHelper::cancel();
		}
		else
		{
			JToolBarHelper::cancel();
		}
	}
}
