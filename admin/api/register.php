<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/13
 * Time: 下午6:23
 */

$config = require_once ('./../config.php');
require_once './../Api.php';

$conn = new mysqli($config["localHost"],$config['userName'],$config["password"],$config['db']);

if($conn->connect_error){
    die("连接失败") or $conn->connect_error."<br>";
}

$name = $_POST["userName"];
$password = $_POST["password"];

$sql_s = "select name from admin where name='$name'";
$res_select = $conn->query($sql_s);

$sql_i = "insert admin (name,password) values('$name','$password')";

if($res_sRow = $res_select ->fetch_assoc()){
    echo API::json(400,'用户名已存在!',array());
    $res_select->free();
}else{

    $res_insert = $conn->query($sql_i);
    if($res_insert){
        echo API::json(100,'用户注册成功',array());
    }else{
        echo API::json(400,'用户注册失败',array());
    }
    $name = "";
    $password = "";
}

$conn->close();
