<?php
/**
 * Cancel action controller class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Cancel action controller class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximControllersCancel extends MaximControllersDefault
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
		$state = $this->model->getState();
		$state->set('id', $this->input->get('id', 0));
		$this->model->getItem()->checkIn();

		$url = 'index.php?option=com_maxim&view=' . $this->toPlural($this->view_name);
		$this->app->redirect($url);

		return true;
	}
}