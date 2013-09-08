<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Cancel action controller class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoControllersSave extends VpetrenkoControllersDefault
{
	/**
	 * Get the redirect url for action
	 *
	 * @param int $id item id
	 *
	 * @return string url to redirect from action
	 */
	private function _redirectTo($id = null)
	{
		$task = $this->input->get('task');

		$goto = "index.php";
		if ($task == "apply" && $task = "add")
		{
			$view = $this->input->get('view');
			$goto = "index.php?option=com_vpetrenko&task=read&view=" . $view . "&id=" . $id;
		}
		elseif ($task == 'save')
		{
			$inflector = JStringInflector::getInstance();
			$view = $inflector->isSingular($this->view_name) ? $inflector->toPlural($this->view_name) : $this->view_name;
			$goto = "index.php?option=com_vpetrenko&view=" . $view;
		}

		return $goto;
	}

	/**
	 * Execute the save action
	 *
	 * @return void
	 */
	public function execute()
	{
		$this->model->setData($this->input->get('jform', null, array()));
		if ($this->model->validate())
		{
			$row = $this->model->store();
			$id = $row->id;
			$row->checkIn($id);

			$this->getApplication()->enqueueMessage(JText::_('com_vpetrenko_SUCCESSFULLY_SAVED'), 'message');

			$goto = $this->_redirectTo($id);
			$this->getApplication()->redirect($goto);
		}
		else
		{
			parent::execute();
			$this->getApplication()->enqueueMessage(JText::_('com_vpetrenko_CHECK_REQUIRES_FIELDS'), 'error');
		}
	}
}