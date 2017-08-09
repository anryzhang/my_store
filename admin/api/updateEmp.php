<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 下午3:30
 */

$config = require_once "./../config.php";
require_once './../Api.php';

$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
}
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$grade = $_POST['grade'];
$salary = $_POST['salary'];

$sql_s = "select id from emp where id=$id";

$res_select = $conn->query($sql_s);


if($res_sRow = $res_select->fetch_assoc()){
    if($res_sRow['id'] == $id){
        $sql_u = "update emp set name='$name',grade='$grade',email='$email',salary='$salary' where id=$id";
        $res_u = $conn->query($sql_u);
        if($res_u){
            echo API::json(100,'更新数据成功',array());

        }else{
            echo API::json(400, '删除失败', array());
        }
        $res_select->free();

    }


}else{
    echo API::json(400,'更新数据失败',array());
}

$conn->close();