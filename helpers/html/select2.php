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
 * select2 Utility class for jQuery JavaScript behaviors.
 *
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @since       3.2
 */
abstract class JHtmlSelect2 extends JHtmlJquery
{
	/**
	 * Array containing information for loaded files.
	 *
	 * @var    array
	 * @since  3.2
	 */
	protected static $loaded = array();

	/**
	 * Method to load the jQuery select2 into the document head.
	 *
	 * @param   string  $selector  The HTML selector.
	 * @param   mixed   $debug     Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   3.2
	 */
	public static function select2($selector = 'select', $debug = null)
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__][$selector]))
		{
			return;
		}

		// Include jQuery framework.
		static::framework();

		// If no debugging value is set, use the configuration setting.
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug  = (boolean) $config->get('debug');
		}

		// Add Stylesheet.
		JHtml::_('stylesheet', 'plg_system_select2/select2.min.css', false, true, false, false, $debug);

		// Add JavaScript.
		JHtml::_('script', 'plg_system_select2/jquery.select2.min.js', false, true, false, false, $debug);

		// Attach the select2 to the document.
		JFactory::getDocument()->addScriptDeclaration(
			"jQuery(document).ready(function() {
				jQuery('$selector').select2();
			});"
		);

		static::$loaded[__METHOD__][$selector] = true;

		return;
	}
}
