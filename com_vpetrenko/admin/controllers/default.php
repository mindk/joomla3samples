<?php
/**
 * Default action controller class file
 *
 * @package   com_vpetrenko
 * @author    VPetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Base abstract controller class
 *
 * @package com_vpetrenko
 * @author  Vpetrenko
 */
abstract class VpetrenkoControllersDefault extends JControllerBase
{
	/**
	 * @var object model
	 */
	protected $model;

	/**
	 * @var string view name
	 */
	protected $view_name;

	/**
	 * @var string layout name
	 */
	protected $layout = 'default';

	/**
	 * Constructor for controller
	 *
	 * @param JInput           $input   data from requests
	 * @param JApplicationBase $app     application instance
	 *
	 * @return VpetrenkoControllersDefault
	 */
	public function __construct(JInput $input = null, JApplicationBase $app = null)
	{
		parent::__construct($input, $app);

		$this->view_name = $this->getApplication()->input->getWord('view', 'students');

		$inflector = JStringInflector::getInstance();
		$model_name = $inflector->isSingular($this->view_name) ? $inflector->toPlural($this->view_name) : $this->view_name;
		$model_class = 'VpetrenkoModels' . ucfirst($model_name);
		$this->input->set('view', $this->view_name);
		$this->model = new $model_class;
	}

	/**
	 * Base method execute action controller
	 *
	 * @return void
	 */
	public function execute()
	{
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $this->view_name . '/tmpl', 'normal');

		$view_format = JFactory::getDocument()->getType();
		$view_class = 'VpetrenkoViews' . ucfirst($this->view_name) . ucfirst($view_format);
		$view = new $view_class($this->model, $paths);
		$this->layout = $this->input->getWord('layout', $this->layout);

		echo $view->setLayout($this->layout)->render();;
	}

}