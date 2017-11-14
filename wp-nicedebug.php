<?php
/*
Plugin Name: Nice Debug
Plugin URI: http://github.com/caherrera/wp-nicedebug
Description: Write whatever you want into this debug file
Version: 1.0
Author: Carlos Herrera
Author URI: https://www.linkedin.com/in/carlosherreracaceres/
*/
// don't load directly
if (!defined('ABSPATH')) {
    die('-1');
}


if (!defined('WP_NICEDEBUG')) {
    define('WP_NICEDEBUG', true);
}
if (!defined('WP_NICEDEBUG_LOG')) {
    define('WP_NICEDEBUG_LOG', true);
}
if (!defined('WP_NICEDEBUG_DISPLAY')) {
    define('WP_NICEDEBUG_DISPLAY', false);
}

require_once __DIR__ . '/functions.php';