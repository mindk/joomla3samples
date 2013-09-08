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
 * Save action controller
 */
class DimaControllersSave extends DimaControllersDefault
{
	/**
	 * @return bool
	 */
	public function execute()
	{
		$redirect_url = 'index.php?option=com_dima';
		$form_data = $this->input->get('jform', array(), 'array');
		$form = $this->model->getForm();
		$item = $this->model->getItem();

		if ($form->validate($form_data))
		{
			if ($item->save($form_data))
			{
				$this->app->enqueueMessage(JText::_('COM_DIMA_SAVE_OK'));
				$this->model->getItem()->checkIn();
			}
			else
			{
				$this->app->enqueueMessage(JText::_('COM_DIM_SAVE_ERROR'), 'error');
				$form->bind($form_data);

				return parent::execute();
			}
		}
		else
		{
			$errors = $form->getErrors();
			if (!empty($errors))
				foreach ($errors as $error)
				{
					$this->app->enqueueMessage($error->getMessage(), 'error');
				}

			$inflector = JStringInflector::getInstance(true);
			$form->bind($form_data);

			$this->view_name = $inflector->toSingular($this->view_name);

			return parent::execute();
		}

		if ('apply' == $this->input->getCmd('task'))
			$redirect_url .= '&task=read&cid[]=' . $item->id;

		$this->app->redirect($redirect_url);
	}
}
