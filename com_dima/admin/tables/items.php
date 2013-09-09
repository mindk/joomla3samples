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
 * Items table class
 *
 * @package     com_dima
 */
class DimaTablesItems extends JTable
{
	/**
	 * Constructor
	 *
	 * @param object $db
	 *
	 * @internal param \Database $object connector object
	 */
	function __construct($db)
	{
		parent::__construct('#__dima_items', 'id', $db);
	}
}