<?php defined('_JEXEC') or die('Restricted access');

class VpetrenkoTablesStudents extends JTable
{
	/**
	 * Students table constructor
	 *
	 * @param object $db database connection instance
	 */
	function __construct($db)
	{
		parent::__construct('#__vpetrenko_students', 'id', $db);
	}
}