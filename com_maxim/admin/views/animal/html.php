<?php
/**
 * Animal edit html view class file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Animal edit html view class
 *
 * @package com_maxim
 * @author  Maxim
 */
class MaximViewsAnimalHtml extends JViewHtml
{
	/**
	 * Method to render the view.
	 *
	 * @return  string  The rendered view.
	 */
	function render()
	{
		$model = $this->model;
		$this->item = $model->getItem();
		$this->state = $model->getState();
		$this->form = $model->getForm();

		JToolbarHelper::apply();
		JToolbarHelper::save();
		JToolbarHelper::cancel();

		return parent::render();
	}

}