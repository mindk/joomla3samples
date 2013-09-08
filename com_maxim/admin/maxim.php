<?php
/**
 * Maxim component main file
 *
 * @package   com_maxim
 * @author    Maxim
 * @copyright 2011-2013 mindk (http://mindk.com). All rights reserved.
 * @license   http://mindk.com Commercial
 */

defined('_JEXEC') or die('Restricted access');

JLoader::registerPrefix('Maxim', JPATH_COMPONENT_ADMINISTRATOR);
JTable::addIncludePath(JPATH_COMPONENT . '/tables');

$task_map = array(
	'apply' => 'save',
	'new' => 'read',
);

$task = JFactory::getApplication()->input->get('task', 'display');
if (empty($task))
{
	$task = 'display';
}
$task = (isset($task_map[$task])) ? $task_map[$task] : $task;

$class_name = 'MaximControllers' . ucwords($task);

$controller = new $class_name();
$controller->execute();
