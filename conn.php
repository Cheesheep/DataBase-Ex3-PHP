<?php 
$hostname = "localhost"; //主机名,可以用IP代替
$database = "exp03"; //数据库名
$username = "root"; //数据库用户名
$password = ""; //数据库密码 空密码

//这里是有跟原来的文档里面给出来的代码不一样，用了新的连接函数
$TABLE_NAME = "";//数据表的名字，用来存储

$conn = mysqli_connect($hostname, $username, $password,$database) or trigger_error(mysql_error() , E_USER_ERROR); 
//mysql_select_db($database, $conn); 
//$db = @mysql_select_db($database, $conn) or die(mysql_error());
?>
