<?php
/**
 * @file:  conn.php
 * @author: henry
 * @time: Tue Nov 15 09:24:05 2016
 * @desc: 连接数据库 
 */

// PDO 连接mysql数据库
$host =  "127.0.0.1";
$user = "root";
$pwd = "";
$dbName = "python";

try{
	$conn = new PDO("mysql:host=".$host.";dbname=".$dbName.";charset=utf8", $user, $pwd);
	// echo "连接成功";
}catch(PDOException $e){
	echo $e->getMessage();
}