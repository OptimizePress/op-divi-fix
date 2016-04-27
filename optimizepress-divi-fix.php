<?php

/**
 *
 * @link              http://www.optimizepress.com/
 * @since             1.0.1
 * @package           Op_Divi_Fix
 *
 * @wordpress-plugin
 * Plugin Name:       OptimizePress Divi theme fix
 * Plugin URI:        http://www.optimizepress.com/
 * Description:       Fix for Live Editor if Divi theme or plugins are used
 * Version:           1.0.0
 * Author:            OptimizePress
 * Author URI:        http://www.optimizepress.com/
 * Text Domain:       op-divi-fix
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action('init' , 'opRemoveDiviCSSStyles', 99);

/**
 * Remove some Divi theme actions to preserve compatibility of Live Editor.
 */
function opRemoveDiviCSSStyles()
{
	$pageBuilder = false;
	if (isset($_GET)) {
		if (array_key_exists('page', $_GET)) {
			$pageBuilder = ($_GET['page'] == 'optimizepress-page-builder' ) ? true : false;
		}
	}

	if ($pageBuilder) {
		remove_action('wp_head', 'et_divi_add_customizer_css');
		remove_action('wp_enqueue_scripts', 'et_builder_load_modules_styles', 11);
		remove_action('wp_footer', 'et_pb_maybe_add_advanced_styles');
	}
}