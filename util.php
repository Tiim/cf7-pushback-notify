<?php
namespace Cf7PushoverNotify;
if ( ! defined( 'ABSPATH' ) ) exit;

class Util {
    public static function formatStr($str, $data) {
        foreach($data as $key => $val) {
            $str = str_replace('{{'.$key.'}}', $val, $str);
        }
        return $str;
    }
}

?>