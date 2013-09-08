<?php defined('_JEXEC') or die('Restricted access');

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
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		JToolBarHelper::title(JText::_('COM_ROOCKBUILDER_TITLE_PAGE'), 'page.png');

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
