<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/9
 * Time: 上午8:19
 */

session_start();



$name = $_POST["name"];
$password = $_POST['password'];

$config = require_once './../config.php';
require_once "./../Api.php";

$conn = new mysqli($config['localHost'], $config['userName'], $config['password'], $config['db']);

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
}



//防注入
$sql = "select name, password from admin where name='$name'";

$res = $conn->query($sql);


if ($row = $res->fetch_assoc()) {
//    if ($row['password'] == md5($password)) {
    if ($row['password'] == $password) {
        $url = "empMain.html";
        $_url = array(
            'url' => $url,
            'name'=> $row['name']
        );
        //cookie
        setCookie("token",md5($row['name'].time()),time()+3600,'/my_store');
        if(!isset($_SESSION['name'])){
            $_SESSION["name"] = $row['name'];
        }

        echo API::json(100, '', $_url);
    }else{
        $obj_array = array();
        echo API::json(400, '用户名或密码不对', $obj_array);
    }
} else {
    $obj_array = array();
    echo API::json(400, '用户名或密码不对', $obj_array);
}

$res->free();
$conn->close();


