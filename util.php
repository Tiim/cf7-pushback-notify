<?php
namespace Cf7PushoverNotify;
if ( ! defined( 'ABSPATH' ) ) exit;

class Util {
    public static function formatStr($str, $data) {
        foreach($data as $key => $val) {
            if (is_array($val)) {
               $val = join(", ", $val);
            }
            $str = str_replace('['.$key.']', $val, $str);
        }
        return $str;
    }
}

?>