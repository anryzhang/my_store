<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/4
 * Time: 下午10:08
 */
require_once "./Api.php";

$rand = mt_rand(0,10);
$citys = array(0=>"上海",1=>"北京",2=>"南京",3=>"广州",4=>"武汉",5=>"重庆",6=>"杭州",7=>"合肥",8=>"宁波",9=>"郑州",10=>"哈尔滨");

$name = $_POST['name'];
//var_dump($name);
$email = $_POST["email"];
$email = strstr($email,'@') ? $email : $email.'@126.com';
$address = $_POST["address"];
$address = $address ? $address : $citys[$rand];
$age = $_POST["age"] ;
$age = $age ? $age : mt_rand(16,100) ;
$sex = $_POST["sex"] == 1 ? '男' : '女';
if (!$name || !$email || !$address) {
    echo "<a href='./../src/form.html'>返回重新填写</a>" . "<br>";
    die("字段不能为空");
}

$conn = new mysqli('localhost', 'root', '123456789', 'my_store');

if ($conn->connect_error) {
    die("连接失败") or $conn->connect_error . "<br>";
} else {
//    echo "连接成功"."<br>";
}
$sql_insert = "insert into user (name,email,address,age,sex) values('$name','$email','$address','$age','$sex')";

$res = $conn->query($sql_insert);

if ($res) {
//    echo "插入一条数据成功"."<br>";

} else {
    echo "插入数据失败" . $conn->error . "<br>";
}

$sql_select = "select * from user";

$result = $conn->query($sql_select);

//var_dump($result);

if ($result->num_rows > 0) {
    $res_array = array();
    while ($row = $result->fetch_object()) {
//        var_dump($row);
        array_push($res_array, $row);
    }
}

$code = 100;
if ($code == 100) {
    $message = "成功";
} else {
    $message = "失败";
}

$res_object = API::json($code,$message,$res_array);

echo $res_object;

$result->free();

$conn->close();