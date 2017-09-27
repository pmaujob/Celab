<?php

class ConvertFormats {

    public static function convertToJsonItems($array) {
        if ($array != null && count($array) > 0) {
            $json = json_encode($array,JSON_UNESCAPED_SLASHES);
            $items = '{ "Items" :';
            $json = "'" . $items . $json . "}'";
            return $json;
        } else {
            return null;
        }
    }

}
?>

