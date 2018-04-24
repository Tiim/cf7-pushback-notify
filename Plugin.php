<?php
namespace Cf7PushoverNotify;

require_once('pushover.php');
require_once('settings.php');

class Plugin {

    public static $ns = 'Cf7PushoverNotify';

    public function install() {
        
    }

    public function registerActions() {
        add_action('wpcf7_submit', self::$ns . '\cf7_submit', 10, 2);
        add_action('admin_init', self::$ns .'\init_settings');
        add_action('admin_menu', self::$ns . '\init_menu');
    }

    public function registerFilters() {
        
    }

    public function activate() {

    }

    public function deactivate() {

    }

}

?>