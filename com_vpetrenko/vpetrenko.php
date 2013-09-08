<?php
/**
 * Start point for controller
 *
 * @package   com_vpetrenko
 * @author    Vpetrenko
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

JLoader::registerPrefix('Vpetrenko', JPATH_COMPONENT_ADMINISTRATOR);
JTable::addIncludePath(JPATH_COMPONENT . '/tables');

$task_map = array(
	'apply' => 'save',
	'new' => 'read'
);

$task = JFactory::getApplication()->input->get('task', 'display');
$task = array_key_exists($task, $task_map) ? $task_map[$task] : $task;
if (empty($task))
{
	$task = 'display';
}
$class_name = 'VpetrenkoControllers' . ucwords($task);

$controller = new $class_name();
$controller->execute();