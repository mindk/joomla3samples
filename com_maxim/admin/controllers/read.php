<?php
/**
 * Read action controller class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Controller for showing form for adding/edit item
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximControllersRead extends MaximControllersDefault
{
	/**
	 * Execute the controller.
	 *
	 * @return  boolean  true if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 */
	public function execute()
	{
		if ('new' == $this->input->get('task'))
		{
			$this->view_name = $this->toSingular($this->view_name);
		}

		$state = $this->model->getState();
		$state->set('id', $this->input->get('id', 0));
		$item = $this->model->getItem();
		if ($item->id > 0)
		{
			if (($item->checked_out) > 0 && ($item->checked_out != JFactory::getUser()->id))
			{
				$this->app->enqueueMessage(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $item->id), 'Error');
				$this->app->redirect('index.php?option=com_maxim&view=' . $this->toPlural($this->view_name));
			}
			else
			{
				$this->model->getItem()->checkOut(JFactory::getUser()->id);
			}
		}

		return parent::execute();
	}
}