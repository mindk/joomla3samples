<?php
/**
 * MaximControllersDefault class file. Abstract class for all controllers
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Abstract class for all controllers
 *
 * @package com_maxim
 * @author  Maxim
 */
abstract class MaximControllersDefault extends JControllerBase
{
	/**
	 * Storage for model
	 *
	 * @var JModelBase
	 */
	protected $model;

	/**
	 * View name
	 *
	 * @var string
	 */
	protected $view_name;

	/**
	 * Layout name
	 *
	 * @var string
	 */
	protected $layout = 'default';

	/**
	 * Created an instance of controller
	 *
	 * @param JInput           $input request data
	 * @param JApplicationBase $app   application instance
	 */
	public function __construct(JInput $input = null, JApplicationBase $app = null)
	{

		parent::__construct($input, $app);

		$this->view_name = $this->app->input->get('view', 'animals');

		$model_name = $this->toPlural($this->view_name);
		$this->app->input->set('view', $this->view_name);

		$model_class = 'MaximModels' . ucfirst($model_name);

		$this->model = new $model_class;
	}

	/**
	 * Execute the controller.
	 *
	 * @return  boolean  true if controller finished execution, false if the controller did not
	 *                   finish execution. A controller might return false if some precondition for
	 *                   the controller to run has not been satisfied.
	 */
	public function execute()
	{
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $this->view_name . '/tmpl', 'normal');

		$view_format = JFactory::getDocument()->getType();
		$view_class = 'MaximViews' . ucfirst($this->view_name) . ucfirst($view_format);
		$view = new $view_class($this->model, $paths);
		$this->layout = $this->app->input->getWord('layout', $this->layout);

		echo $view->setLayout($this->layout)->render();
		return true;
	}

	/**
	 * Returns word in the plural form
	 *
	 * @param string $word word, that need to change
	 *
	 * @return string plural form of word
	 */
	public function toPlural($word)
	{
		$inflector = JStringInflector::getInstance();

		return $inflector->isPlural($word) ? $word : $inflector->toPlural($word);
	}

	/**
	 * Returns word in the single form
	 *
	 * @param string $word word, that need to change
	 *
	 * @return string single form of word
	 */
	public function toSingular($word)
	{
		$inflector = JStringInflector::getInstance();

		return $inflector->toSingular($word);
	}
}