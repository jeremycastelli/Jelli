<?php
/**
 * Functions
 */


/**
 * constant
 **/
define('PATH', STYLESHEETPATH);
define('FUNCTIONS_PATH', PATH . '/functions/');


/**
 * language & localization
 **/
require_once(FUNCTIONS_PATH . 'language.php');

/**
 * login page
 **/
require_once(FUNCTIONS_PATH . 'login.php');

/**
 * admin and core things
 **/
require_once (FUNCTIONS_PATH . 'admin.php');
require_once (FUNCTIONS_PATH . 'dashboard.php');

/**
 * menu
 **/
require_once (FUNCTIONS_PATH . 'menu.php');

/**
 * content
 */
require_once (FUNCTIONS_PATH . 'content.php');

/**
 * social
 */
require_once(FUNCTIONS_PATH . 'social.php');

/**
 * content
 */
require_once (FUNCTIONS_PATH . 'images.php');

/**
 * comments
 */
require_once (FUNCTIONS_PATH . 'comments.php');

/**
 * Shortcodes
 */
require_once (FUNCTIONS_PATH . 'shortcodes.php');
require_once (FUNCTIONS_PATH . 'shortcodes-images.php');

/**
 * Sidebars and Widgets
 */
require_once (FUNCTIONS_PATH . 'widget.php');


//divers

//hide version number
remove_action('wp_head', 'wp_generator');

add_post_type_support( 'page', 'excerpt' );

?>