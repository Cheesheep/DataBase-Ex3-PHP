
<?php 
include ("../conn.php");
//mysql_query("set names gb2312");
$id=$_GET['id'];
$sql = "delete from customers where cid='$id'"; //这里因为id是字符串所以要多加个引号
$result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
if($result1)
{
    echo "<script language=javascript>
    window.location.href='show_cus.php';</script>";
} 
?>