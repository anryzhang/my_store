<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 下午2:09
 */
session_start();
$config = require_once "./../config.php";
require_once './../Api.php';

$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
}

$id = $_POST['id'];

$cookie = $_COOKIE['token'];

if(!isset($cookie)){
    echo API::json(300, '用户没有权限,请先登录', array());
    die();
}
if(!isset($_SESSION['name'])){
    echo API::json(300, '用户没有权限,请先登录', array());
    $conn->close();
    die();
}
$sql_s = "select id from emp where id=$id";

$res_select = $conn->query($sql_s);

$sql_d = "delete from emp WHERE id = '$id'";

if ($res_sRow = $res_select->fetch_assoc()) {
    if ($res_sRow['id'] == $id) {
        $res_del = $conn->query($sql_d);
        if ($res_del) {
            echo API::json(100, '删除成功', array());
        } else {
            echo API::json(400, '删除失败', array());
        }
        $res_select->free();
    }
} else {
    echo API::json(400, '删除失败', array());
}



$conn->close();



