<?php 
include("../conn.php");
$sql = "SELECT * FROM customers";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_field($result);
var_dump($row);
echo $row->name;
$row = mysqli_fetch_field($result);
var_dump($row);
