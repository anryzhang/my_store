<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 下午2:09
 */

$config = require_once "./../config.php";
require_once './../Api.php';

$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
}

$id = $_POST['id'];

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



