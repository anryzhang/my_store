<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/4
 * Time: 下午10:08
 */

$name = $_POST['name'];
//var_dump($name);
$email = $_POST["email"];
$address = $_POST["address"];
if(!$name || !$email || !$address){
    echo "<a href='./../src/form.html'>返回重新填写</a>"."<br>";
    die("字段不能为空");
}

$conn = new mysqli('localhost','root','123456789','my_store');

if($conn->connect_error){
    die("连接失败") or $conn->connect_error ."<br>";
}else{
    echo "连接成功"."<br>";
}
$sql_insert = "insert into user (name,email,address) values('$name','$email','$address')";

$res = $conn ->query($sql_insert);

if($res){
    echo "插入一条数据成功"."<br>";

}else{
    echo "插入数据失败".$conn->error."<br>";
}

$sql_select = "select * from user";

$result = $conn->query($sql_select);

//var_dump($result);

if($result->num_rows>0){
    $res_array = array();
    while ($row = $result->fetch_object()){
//        var_dump($row);
        array_push($res_array,$row);
    }
}

echo json_encode($res_array,JSON_UNESCAPED_UNICODE);

$result->free();

$conn->close();