<?php
/**
 * Read and create action controller class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Read and create new entity action controller class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoControllersRead extends VpetrenkoControllersDefault
{

	/**
	 * Execute the read or new action
	 *
	 * @return void
	 */
	function execute()
	{
		$inflector = JStringInflector::getInstance(true);
		if ('new' == $this->input->get('task'))
		{
			$this->view_name = $inflector->toSingular($this->view_name);
		} else {
			$state = $this->model->getState();
			$id = $this->input->getInt('id', 0);
			$state->set('id', $id);
			$item=$this->model->getItem();
			if ($item->isCheckedOut(JFactory::getUser()->id)){
				$this->view_name = $inflector->toPlural($this->view_name);
				$this->getApplication()->enqueueMessage(JText::_('com_vpetrenko_LOCKED_ITEM'), 'error');
				$this->getApplication()->redirect("index.php?option=com_vpetrenko&view=".$this->view_name);
			} else {
				$item->checkOut(JFactory::getUser()->id,$id );
			}
		}

		parent::execute();
	}

}