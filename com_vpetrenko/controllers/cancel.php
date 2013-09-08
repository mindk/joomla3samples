<?php

defined('_JEXEC') or die('Restricted access');

/**
 * Cancel action controller class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoControllersCancel extends VpetrenkoControllersDefault
{
	/**
	 * Execute the cancel action
	 *
	 * @return void
	 */
	public function execute()
	{
		$inflector = JStringInflector::getInstance();

		$data = $this->input->get('jform', null, array());
		$this->model->getItem()->checkIn($data['id']);
		$view = $inflector->isPlural($this->view_name) ? $this->view_name : $inflector->toPlural($this->view_name);

		$this->getApplication()->enqueueMessage(JText::_('com_vpetrenko_SUCCESSFULLY_SAVED'), 'message');
		$this->getApplication()->redirect('index.php?option=com_vpetrenko&view=' . $view);
	}

}