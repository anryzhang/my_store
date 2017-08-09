<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 下午1:05
 */


$config = require_once './../config.php';
require_once "./../Api.php";


$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if($conn->connect_error){
    die("连接失败") or $conn->connect_error ."<br>";
}

$sql_s = "select * from emp";

$res = $conn->query($sql_s);
$res_object = array();

if($res->num_rows>0){
    $res_array = array();
    while($row = $res->fetch_object()){
//        var_dump($row);
        array_push($res_array,$row);
    }
    $res_object = API::json(100,'',$res_array);
}else{
    $res_object = API::json(400,'失败',array());
}

echo $res_object;

$res->free();
$conn->close();
