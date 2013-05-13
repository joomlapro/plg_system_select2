<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Select2
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_BASE') or die;

/**
 * Joomla Select2 plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Select2
 * @since       3.1
 */
class PlgSystemSelect2 extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.1
	 */
	public function onAfterDispatch()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return true;
		}

		// Register dependent classes.
		JLoader::register('JHtmlSelect2', __DIR__ . '/helpers/html/select2.php');

		// Register a function.
		JHtml::register('jquery.select2', array('JHtmlSelect2', 'select2'));

		// Force load script.
		if ($this->params->get('force'))
		{
			// Load the select2 jquery script.
			JHtml::_('jquery.select2', $this->params->get('selector', 'select'));
		}

		return true;
	}
}
