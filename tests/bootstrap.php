<?php
/**
 * PHPUnit bootstrap file.
 *
 * @package Plugin_Sentinal
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

// Forward custom PHPUnit Polyfills configuration to PHPUnit bootstrap file.
$_phpunit_polyfills_path = getenv( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH' );
if ( false !== $_phpunit_polyfills_path ) {
	define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', $_phpunit_polyfills_path );
}

if ( ! file_exists( "{$_tests_dir}/includes/functions.php" ) ) {
	echo "Could not find {$_tests_dir}/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once "{$_tests_dir}/includes/functions.php";

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
	// Load the plugin file
	require dirname( dirname( __FILE__ ) ) . '/plugin-sentinal.php';
}

// Load the plugin before WordPress loads
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment
require "{$_tests_dir}/includes/bootstrap.php";

/**
 * Plugin activation strategy for testing:
 * 
 * When running WordPress tests, plugins are loaded via 'muplugins_loaded' hook as must-use plugins,
 * but they are not registered in the WordPress active_plugins option. This can cause issues with 
 * tests that specifically check if a plugin is active.
 * 
 * The strategy below:
 * 1. Registers the plugin in the active_plugins option using several possible path formats
 * 2. Ensures the plugin is functionally active for all tests
 */
$plugin_dir_path = dirname(dirname(__FILE__));
$plugin_basename = basename($plugin_dir_path);

// Try several possible plugin paths to ensure compatibility
$possible_plugin_paths = [
    'plugin-sentinal/plugin-sentinal.php',  // Standard plugin path format
    $plugin_basename . '/plugin-sentinal.php',  // Using actual basename
    basename(WP_CONTENT_DIR) . '/plugins/' . $plugin_basename . '/plugin-sentinal.php'  // Full path relative to WP_CONTENT_DIR
];

// Add each path to active_plugins option
foreach ($possible_plugin_paths as $plugin_path) {
    $active_plugins = (array) get_option('active_plugins', array());
    if (!in_array($plugin_path, $active_plugins)) {
        $active_plugins[] = $plugin_path;
        update_option('active_plugins', $active_plugins);
    }
}

// If plugin class is not loaded for some reason, try loading the plugin file directly
if (!class_exists('Plugin_Sentinal')) {
    $plugin_file = $plugin_dir_path . '/plugin-sentinal.php';
    if (file_exists($plugin_file)) {
        require_once $plugin_file;
    }
}
