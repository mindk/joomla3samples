<?php
/**
 * Display action controller class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Display action controller class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
class VpetrenkoControllersDisplay extends VpetrenkoControllersDefault
{
	/**
	 * Execute the display action
	 *
	 * @return void
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

		parent::execute();
	}

}