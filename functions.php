<?php
/*
 * Functions file
 * Calls all other required files
 * PLEASE DO NOT EDIT THIS FILE IN ANY WAY
 *
 * @package iced_mocha
 */

// variable for theme version
define ("iced_mocha_VERSION","1.0");

require_once(dirname(__FILE__) . "/admin/main.php"); // Load necessary admin files

//Loading include files
require_once(dirname(__FILE__) . "/includes/theme-setup.php");     // Setup and init theme
require_once(dirname(__FILE__) . "/includes/theme-styles.php");    // Register and enqeue css styles and scripts
require_once(dirname(__FILE__) . "/includes/theme-loop.php");      // Loop functions
require_once(dirname(__FILE__) . "/includes/theme-meta.php");      // Meta functions
require_once(dirname(__FILE__) . "/includes/theme-frontpage.php"); // Frontpage styling
require_once(dirname(__FILE__) . "/includes/theme-comments.php");  // Comment functions
require_once(dirname(__FILE__) . "/includes/theme-functions.php"); // Misc functions
require_once(dirname(__FILE__) . "/includes/theme-hooks.php");     // Hooks
require_once(dirname(__FILE__) . "/includes/widgets.php");     // Hooks
require_once(dirname(__FILE__) . "/includes/ajax.php");     // Hooks
require_once(dirname(__FILE__) . "/includes/espresso-template-functions.php");     // Event Espresso
