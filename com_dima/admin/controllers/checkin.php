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
 * Checkin action controller
 *
 * @package     com_dima
 */
class DimaControllersCheckin extends DimaControllersDefault
{
	/**
	 * Execute action
	 *
	 * @return bool
	 */
	public function execute()
	{
		$state = $this->model->getState();
		$inflector = JStringInflector::getInstance(true);

		$cid = $this->input->get('cid', array(), 'array');

		if (!empty($cid))
			$state->set('id', array_shift($cid));

		$this->model->setState($state);
		$item = $this->model->getItem();

		if ($item->isCheckedOut(JFactory::getUser()->id))
		{
			$this->app->enqueueMessage(JText::_('COM_DIM_CHECKED_OUT_WARNING'), 'notice');
			return parent::execute();
		}

		$this->model->getItem()->checkIn($state->get('id', 0));
		$this->app->enqueueMessage(JText::_('COM_DIM_CHECKED_IN_OK'), 'notice');

		$this->app->redirect('index.php?option=com_dima');
	}
}
