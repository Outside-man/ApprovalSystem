<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/7
 * Time: 下午7:16
 */

function p_array($array, $var){
    if(isset($array[$var])){
        echo $array[$var];
    }else{
        echo "";
    }
}