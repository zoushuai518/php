<?php

function getUserIP() {
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        echo 1;
        echo '<br/>';
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            echo 2;
            echo '<br/>';
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            echo 3;
            echo '<br/>';
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        echo 4;
        echo '<br/>';
        return $_SERVER['REMOTE_ADDR'];
    }
}

echo getUserIP();
