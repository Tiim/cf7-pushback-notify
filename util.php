<?php
namespace Cf7PushoverNotify;

class Util {
    public static $prefix = 'cf7pn_';

    public static function prefixStr($str) {
        return self::$prefix . $str;
    }

    public static function formatStr($str, $data) {
        foreach($data as $key => $val) {
            $str = str_replace('{{'.$key.'}}', $val, $str);
        }
        return $str;
    }
}

?>