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
 * Items table class
 */
class DimaTablesItems extends JTable
{
	/**
	 * Constructor
	 *
	 * @param string $db
	 *
	 * @internal param \Database $object connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__dima_items', 'id', $db);
	}
}