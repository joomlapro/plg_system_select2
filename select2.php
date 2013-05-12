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
 * Select2 plugin.
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

		// Add JavaScript Frameworks.
		JHtml::_('jquery.framework');

		// Add Stylesheet.
		JHtml::stylesheet('plg_system_select2/select2.css', false, true, false);

		// Add JavaScript.
		JHtml::script('plg_system_select2/jquery.select2.min.js', false, true);

		// Get the document object.
		$doc = JFactory::getDocument();

		// Build the script.
		$script = array();
		$script[] = 'jQuery.noConflict();';
		$script[] = '(function($) {';
		$script[] = '	$(function() {';
		$script[] = '		$(\'' . $this->params->get('selector', 'select') . '\').select2();';
		$script[] = '	});';
		$script[] = '})(jQuery);';

		// Add the script to the document head.
		$doc->addScriptDeclaration(implode("\n", $script));

		return true;
	}
}
