<?php
/**
 * @package     com_dima
 *
 * @author      Davidov D.
 * @copyright   Copyright (C) 2013 Mindk, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Display item list controller
 *
 * @package     com_dima
 */
class DimaControllersDisplay extends DimaControllersDefault
{
	/**
	 * Execute action
	 *
	 * @return bool
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

		$this->model->setState($state);

		return parent::execute();
	}
}