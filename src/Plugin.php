<?php
namespace Cf7PushoverNotify;
if ( ! defined( 'ABSPATH' ) ) exit;

require_once('PushoverHandler.php');
require_once('Settings.php');
require_once('vendor/Admin-Api.php');

class Plugin {

    public static $ns = 'Cf7PushoverNotify';
    public $_token = 'cf7pn';
    public $prefix = 'cf7pn_';

    public function __construct($file) {
        $this->file = $file;
        $this->settings = new Settings($this);
        $this->pushover = new PushoverHandler($this);

        // Load API for generic admin functions
		if ( is_admin() ) {
			$this->admin = new Admin_API();
        }
        
        register_activation_hook($file, array(&$this, 'activate'));
        register_deactivation_hook($file, array(&$this, 'deactivate'));

        $this->registerActions();
        $this->registerFilters();
    }

    public function registerActions() {
        add_action('wpcf7_submit', array($this->pushover, 'submit'), 10, 2);
    }

    public function registerFilters() {
        
    }

    public function activate() {

    }

    public function deactivate() {

    }

}

?>