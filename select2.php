<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Select2
 *
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     Commercial License
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Joomla Select2 plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Select2
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.2
 */
class PlgSystemSelect2 extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public function onAfterDispatch()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return;
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

		return;
	}
}
