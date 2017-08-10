<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/6
 * Time: 下午8:25
 */

class API{
    public static function json($code,$message="",$data=array(),$pageInfo = ""){
        if(!is_numeric($code)){
            return '';
        }
        if(empty($pageInfo)){
            $result = array(
                "code"=>$code,
                "message"=>$message,
                "data"=>$data
            );
        }else{
            $result = array(
                "code"=>$code,
                "message"=>$message,
                "data"=>$data,
                "pageInfo"=>$pageInfo
            );
        }

        return json_encode($result,JSON_UNESCAPED_UNICODE);
        exit;

    }
}