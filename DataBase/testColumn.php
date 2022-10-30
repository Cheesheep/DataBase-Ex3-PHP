<?php 
include("../conn.php");
$sql = "SELECT * FROM employees";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_field($result);
var_dump($row);
echo $row->name; //表的第一个列名
$row = mysqli_fetch_field($result);
var_dump($row);//第二个列名
$nums =mysqli_num_fields($result);
var_dump($nums);//列的个数
