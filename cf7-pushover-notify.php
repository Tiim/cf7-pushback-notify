<?php
/*
   Plugin Name: Cf7 Pushover Notify
   Plugin URI: http://wordpress.org/extend/plugins/cf7-pushover-notify/
   Version: 0.1
   Author: <a href="https://tiim.github.io/">Tim Bachmann</a>
   Description: Pushover Notifications for Contact Form 7
   Text Domain: cf7-pushover-notify
   License: GPLv3
  */

$Cf7PushoverNotify_minimalRequiredPhpVersion = '5.3';

/**
 * Check the PHP version and give a useful error message if the user's version is less than the required version
 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying
 * an error message on the Admin page
 */
function Cf7PushoverNotify_noticePhpVersionWrong() {
    global $Cf7PushoverNotify_minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "Cf7 Pushover Notify" requires a newer version of PHP to be running.',  'cf7-pushover-notify').
            '<br/>' . __('Minimal version of PHP required: ', 'cf7-pushover-notify') . '<strong>' . $Cf7PushoverNotify_minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'cf7-pushover-notify') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function Cf7PushoverNotify_PhpVersionCheck() {
    global $Cf7PushoverNotify_minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $Cf7PushoverNotify_minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'Cf7PushoverNotify_noticePhpVersionWrong');
        return false;
    }
    return true;
}


/**
 * Initialize internationalization (i18n) for this plugin.
 * References:
 *      http://codex.wordpress.org/I18n_for_WordPress_Developers
 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631
 * @return void
 */
function Cf7PushoverNotify_i18n_init() {
    //$pluginDir = dirname(plugin_basename(__FILE__));
    //load_plugin_textdomain('cf7-pushover-notify', false, $pluginDir . '/languages/');
}


//////////////////////////////////
// Run initialization
/////////////////////////////////

// Initialize i18n
//add_action('plugins_loadedi','Cf7PushoverNotify_i18n_init');

// Run the version check.
// If it is successful, continue with initialization for this plugin
if (Cf7PushoverNotify_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('cf7-pushover-notify_init.php');
    Cf7PushoverNotify_init(__FILE__);
}
