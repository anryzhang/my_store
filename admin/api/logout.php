
<?php
/**
 * Created by PhpStorm.
 * User: ziyu
 * Date: 2017/8/14
 * Time: 下午8:47
 */

require_once "./../Api.php";

session_start();
$_cookie = $_COOKIE['token'];

if(isset($_SESSION['name'])){
    $_SESSION = array();
    if(isset($_COOKIE['token'])){
        setcookie('token','',time()-3600);
    }
    echo API::json(100,'',array());
    session_destroy();
}