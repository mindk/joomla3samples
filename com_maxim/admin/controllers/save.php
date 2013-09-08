<?php
/**
 * Save action controller class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Save action controller class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximControllersSave extends MaximControllersDefault
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
		$form_data = $this->input->get('jform', null, 'array');
		$form = $this->model->getForm();

		if ($form->validate($form_data))
		{
			$item = $this->model->getItem();
			if ($item->save($form_data))
			{
				$item->checkIn();
			}
			else
			{
				$this->app->enqueueMessage(JText::_('COM_MAXIM_SAVE_ERROR'), 'Error');
				$form->bind($form_data);

				return parent::execute();
			}
		}
		else
		{
			foreach ($form->getErrors() as $error)
			{
				$this->app->enqueueMessage($error->getMessage(), 'Error');
			}
			$form->bind($form_data);

			return parent::execute();
		}

		$this->app->redirect($this->_getRedirectUrl($item->id));
	}

	/**
	 * Returns url for redirect after save
	 *
	 * @param string $id id of item, that was changed
	 *
	 * @return string
	 */
	private function _getRedirectUrl($id = '')
	{
		$task = $this->input->get('task');

		$result = 'index.php';
		if ($task == 'apply')
		{
			$view = $this->input->get('view');
			$result = 'index.php?option=com_maxim&task=read&view=' . $view . '&id=' . $id;
		}
		elseif ($task == 'save')
		{
			$result = 'index.php?option=com_maxim&view=' . $this->toPlural($this->view_name);
		}

		return $result;
	}
}