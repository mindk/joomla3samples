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
 * Read action controller
 */
class DimaControllersRead extends DimaControllersDefault
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
		$id = array_shift($cid);

		$state->set('id', $id ? $id : 0);

		$this->model->setState($state);
		$item = $this->model->getItem();

		if ($item->isCheckedOut(JFactory::getUser()->id))
		{
			$this->app->enqueueMessage(JText::_('COM_DIM_CHECKED_OUT_WARNING'), 'notice');
			return parent::execute();
		}

		if ($id)
		{
			$this->model->getItem()->checkOut(JFactory::getUser()->id);
		}
		$this->view_name = $inflector->toSingular($this->view_name);

		return parent::execute();
	}
}