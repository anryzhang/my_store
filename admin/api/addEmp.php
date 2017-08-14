<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 下午2:48
 */

$config = require_once "./../config.php";
require_once './../Api.php';

$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
}

$cookie = $_COOKIE['token'];

if(!isset($cookie)){
    echo API::json(300, '用户没有权限,请先登录', array());
    die();
}

$name = $_POST['name'];
$email = $_POST['email'];
$grade = $_POST['grade'];
$salary = $_POST['salary'];

$sql_i = "insert emp (name,grade,email,salary) values('$name','$grade','$email','$salary')";

$res_i  = $conn->query($sql_i);

if($res_i){
    echo API::json(100, '插入成功', array());
}else{
    echo API::json(400, '插入失败', array());

}

$conn->close();