<?php
/**
 * Display list action controller class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Display list action controller class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximControllersDisplay extends MaximControllersDefault
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

		$state->set('limitstart', $this->app->getUserStateFromRequest($this->view_name . '.limitstart', 'limitstart', 0));
		$state->set('limit', $this->app->getUserStateFromRequest($this->view_name . '.limit', 'limit', $this->app->getCfg('list_limit'), 'int'));

		$list_order = $this->app->getUserStateFromRequest($this->view_name . '.ordercol', 'filter_order', 'id');
		$list_direction = $this->app->getUserStateFromRequest($this->view_name . '.orderdirn', 'filter_order_Dir', 'ASC');

		$state->set('list.ordering', $list_order);
		$state->set('list.direction', $list_direction);

		return parent::execute();
	}
}