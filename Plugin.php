<?php
namespace Cf7PushoverNotify;

require_once('Hooks.php')

class Plugin {

    $hooks = new Hooks();

    public function install() {
        
    }

    public function registerActions() {
        add_action('wpcf7_submit', array(&$hooks, 'onCf7Submit'));
        add_action('admin_menu', array(&$hooks, 'settingsPage'));

    }

    public function registerFilters() {
        
    }

    public function activate() {

    }

    public function deactivate() {

    }

}

?>