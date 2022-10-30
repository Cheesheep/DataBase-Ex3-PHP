
<?php 
include ("../conn.php");

//mysql_query("set names gb2312");
if(isset($_GET['table'])){
    $TABLE_NAME = $_GET['table'];
}
$query = "SELECT * FROM $TABLE_NAME";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));
$id_row = mysqli_fetch_field($res)->name; //获取第i个列名字

$id=$_GET['id'];
$sql = "DELETE FROM $TABLE_NAME where $id_row='$id'"; //这里因为id是字符串所以要多加个引号
$result1 = mysqli_query($conn,$sql) or die(mysqli_error($conn));
if($result1)
{
    echo "<script language=javascript>
    window.location.href='show_dat.php?table=$TABLE_NAME';</script>";
} 
?>