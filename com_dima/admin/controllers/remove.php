<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_dima
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

/**
 * Remove action controller
 */
class DimaControllersRemove extends DimaControllersDefault
{
	/**
	 * Execute action
	 *
	 * @return bool
	 */
	public function execute()
	{
		$state = $this->model->getState();

		$cid = $this->input->get('cid', array(), 'array');
		if (!empty($cid))
			JArrayHelper::toInteger($cid, 0);

		$state->set('cid', $cid);
		$this->model->setState($state);

		if ($this->model->delete())
		{
			$this->app->enqueueMessage(JText::_('COM_DIM_DELETED_OK'));
		}
		else
		{
			$this->app->enqueueMessage(JText::_('COM_DIM_DELETED_ERROR'), 'error');
		}

		$this->app->redirect('index.php?option=com_dima');
	}
}