<?php

function Cf7PushoverNotify_init($file) {
    require_once('Plugin.php');
    $plugin = new Cf7PushoverNotify\Plugin($file);
}
