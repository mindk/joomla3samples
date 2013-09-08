<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_dima
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

JLoader::registerPrefix('Dima', JPATH_COMPONENT_ADMINISTRATOR);
JTable::addIncludePath(JPATH_COMPONENT . '/tables');

// Task mapping:
$task_map = array(
	'apply' => 'save',
	'new' => 'read'
);

$task = JFactory::getApplication()->input->get('task', 'display');
if (empty($task))
{
	$task = 'display';
}
$task = (isset($task_map[$task])) ? $task_map[$task] : $task;

$class_name = 'DimaControllers' . ucwords($task);

$controller = new $class_name();
$controller->execute();