<?php

function Cf7PushoverNotify_init($file) {

    require_once('Plugin.php');
    $plugin = new Cf7PushoverNotify\Plugin();

    $plugin->install();

    $plugin->registerActions();
    $plugin->registerFilters();

    if (!$file) {
        $file = __FILE__;
    }
    register_activation_hook($file, array(&$plugin, 'activate'));


    register_deactivation_hook($file, array(&$plugin, 'deactivate'));
}
