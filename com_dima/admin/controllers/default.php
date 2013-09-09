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
 * Abstract base controller class
 *
 * @package     com_dima
 */
abstract class DimaControllersDefault extends JControllerBase
{
	/**
	 * @var JModelBase
	 */
	protected $model;

	/**
	 * @var string
	 */
	protected $view_name;

	/**
	 * @var string  Layout name
	 */
	protected $layout = 'default';

	/**
	 * Class Constructor
	 *
	 * @param JInput           $input
	 * @param JApplicationBase $app
	 *
	 * @return \DimaControllersDefault
	 */
	public function __construct(JInput $input = null, JApplicationBase $app = null)
	{
		parent::__construct($input, $app);

		$this->view_name = $this->app->input->get('view', 'items');

		$inflector = JStringInflector::getInstance();
		$model_name = $inflector->isPlural($this->view_name) ? $this->view_name : $inflector->toPlural($this->view_name);
		$this->app->input->set('view', $this->view_name);

		$model_class = 'DimaModels' . ucfirst($model_name);

		$this->model = new $model_class;

		return $this;
	}

	/**
	 * Execute action
	 *
	 * @return bool
	 */
	public function execute()
	{
		$paths = new SplPriorityQueue;
		$paths->insert(JPATH_COMPONENT . '/views/' . $this->view_name . '/tmpl', 'normal');

		$view_format = JFactory::getDocument()->getType();
		$view_class = 'DimaViews' . ucfirst($this->view_name) . ucfirst($view_format);
		$view = new $view_class($this->model, $paths);
		$this->layout = $this->app->input->getWord('layout', $this->layout);

		echo $view->setLayout($this->layout)->render();

		return true;
	}
}