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

$pageIndex = $_POST["pageIndex"]; //当前页面索引
$pageSize = $_POST["pageSize"]; //每页条数
$pageCount = 0; //总页数
$rowCount = 0; //总条数
//查询总条数
$sql_row = "select count(id) from emp";

$res_row = $conn->query($sql_row);
if($resRow = $res_row->fetch_row()){
    $rowCount = $resRow[0];
    $res_row->free();
}

$pageCount = ceil($rowCount/$pageSize);

$pageInfo = array(
    "pageIndex"=>$pageIndex,
    "pageSize"=>$pageSize,
    "pageCount"=>$pageCount
);

$sql_s = "select * from emp order by id desc limit ".($pageIndex-1)*$pageSize .",$pageSize";

$res = $conn->query($sql_s);
$res_object = array();

if($res->num_rows>0){
    $res_array = array();
    while($row = $res->fetch_object()){
//        var_dump($row);
        array_push($res_array,$row);
    }
    $res_object = API::json(100,'',$res_array,$pageInfo);
}else{
    $res_object = API::json(400,'失败',array());
}

echo $res_object;

$res->free();
$conn->close();
