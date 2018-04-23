<?php
namespace Cf7PushoverNotify;

require_once('pushover.php');
require_once('hooks.php');

class Plugin {

    public function install() {
        
    }

    public function registerActions() {
        add_action('wpcf7_submit', 'Cf7PushoverNotify\onCf7Submit', 10, 2);
    }

    public function registerFilters() {
        
    }

    public function activate() {

    }

    public function deactivate() {

    }

}

?>