<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/6
 * Time: 下午8:25
 */

class API{
    public static function json($code,$message="",$data=array()){
        if(!is_numeric($code)){
            return '';
        }
        $result = array(
            "code"=>$code,
            "message"=>$message,
            "data"=>$data
        );
        return json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;

    }
}