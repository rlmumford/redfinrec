<?php

// @codingStandardsIgnoreFile

/**
 * Location of the site configuration files.
 *
 * The $settings['config_sync_directory'] specifies the location of file system
 * directory used for syncing configuration data. On install, the directory is
 * created. This is used for configuration imports.
 *
 * The default location for this directory is inside a randomly-named
 * directory in the public files path. The setting below allows you to set
 * its location.
 */
$settings['config_sync_directory'] = '../config/sync';

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

// Automatically generated include for settings managed by ddev.
if (file_exists($app_root . '/' . $site_path . '/settings.ddev.php') && getenv('IS_DDEV_PROJECT') == 'true') {
  include $app_root . '/' . $site_path . '/settings.ddev.php';

  if (file_exists($app_root . '/' . $site_path . '/services.monolog.ddev.yml')) {
    $settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.monolog.ddev.yml';
  }

  $config['system.logging']['error_level'] = ERROR_REPORTING_DISPLAY_VERBOSE;

  // Set up the filesystem.
  $settings['file_temp_path'] = '/tmp';
  $settings['file_private_path'] = '../.ddev/private';

  /**
   * Disable CSS and JS aggregation.
   */
  $config['system.performance']['css']['preprocess'] = FALSE;
  $config['system.performance']['js']['preprocess'] = FALSE;
}

// Include automatic Platform.sh settings.
if (file_exists($app_root . '/' . $site_path . '/settings.platformsh.php')) {
  require_once($app_root . '/' . $site_path . '/settings.platformsh.php');
}

// Include local settings. These come last so that they can override anything.
$on_platformsh = !empty($_ENV['PLATFORM_PROJECT']);
if (file_exists($app_root . '/' . $site_path . '/settings.local.php') && !$on_platformsh) {
  require_once($app_root . '/' . $site_path . '/settings.local.php');
}

if ($on_platformsh && file_exists($app_root . '/' . $site_path . '/services.monolog.platformsh.yml')) {
  $settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.monolog.platformsh.yml';
}

if (file_exists($app_root . '/' . $site_path . '/services.ddev.yml') && getenv('IS_DDEV_PROJECT') == 'true') {
  $settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.ddev.yml';
}
else if (file_exists($app_root . '/' . $site_path . '/services.local.yml') && !$on_platformsh) {
  $settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.local.yml';
}
