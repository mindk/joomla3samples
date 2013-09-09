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
 * Cancel action controller
 *
 * @package     com_dima
 */
class DimaControllersCancel extends DimaControllersDefault
{
	/**
	 * Cancel action
	 *
	 * @return bool
	 */
	public function execute()
	{
		$form_data = $this->input->get('jform', array(), 'array');

		$id = isset($form_data['id']) ? $form_data['id'] : 0;
		$this->model->getItem()->checkIn($id);

		$this->app->enqueueMessage('COM_DIM_CANCELLED');

		$this->app->redirect('index.php?option=com_dima');
	}
}