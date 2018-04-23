<?php
namespace Cf7PushoverNotify;

$prefix = 'cf7pn_';

function prefixStr($str) {
    global $prefix;
    return $prefix . $str;
}

?>