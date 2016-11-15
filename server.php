<?php
/**
 * @file:  server.php
 * @author: henry
 * @time: Tue Nov 15 09:22:02 2016
 * @desc: php开发api的服务器端 
 */

require 'conn.php';
header('Content-Type:text/html;charset=utf-8');
$action = $_GET['action'];
switch($action){
	//注册会员
	/**
	 * 0:注册成功，1:密码错误，2:用户名不存在，3:用户名密码错误
	 */
case 'adduserinfo':
	$username = trim($_GET['username']);
	$password2 = trim($_GET['password']);
	$password = md5($password2 . ALL_PS);
	$email = trim($_GET['email']);
	if($username == "" || $password2 == "" || $password ==""){
		$res = urlencode("参数有误！");
		exit(json_encode($res));
	}
	$sql = "SELECT `name` from users where name = '" .$username."'";
	$query = mysql_query($sql, $conn);
	$count = mysql_num_rows($query);
	if($count > 0){
		exit(json_encode(1));//注册失败，返回1
	}else{
		$addsql =  "INSERT INTO users(`name`,`password`,`email`) VALUES( '".$username."', '".$password."', '".$email."')";
		$conn->exec($addsql);
		exit(json_encode(0));//注册成功，返回0
	}
	break;
}
