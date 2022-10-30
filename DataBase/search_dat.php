<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>表名列表</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" type="text/css" href="style_dat.css"> -->
        <style type="text/css">
body{
    text-align: center;
    background-image: url("../img/Italy.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
}
.headlogo{
    text-transform:UpperCase;
    font-size: 50px;
    font-weight: bold;
    font-family: LiSu;
    color: antiquewhite;
}
.home-button{
    padding:2px 4px 2px;
}
.home-button a{
    font-size:15px;
    text-decoration:none;
    color:antiquewhite;
    transition-duration:0.3s;
}
.home-button a:hover{
    color:rgb(13, 56, 59);
}
.dept-box{
    margin:0 auto;
    margin-top: 50px;
}
.dept-table{
    font-size:15px;
    letter-spacing:1px;
    background-color:rgb(13, 56, 59);
    display: inline-block;
    color: antiquewhite;
    transition-duration:0.8s;
}
.dept-table a,input{
    text-decoration:none;
    color:rgb(13, 56, 59);
    background-color:antiquewhite;
    border-radius:5px;
    padding:3px;
    cursor: pointer;
    transition-duration:0.3s;
}
.dept-table a:hover,input:hover{
    background-color:rgb(214, 186, 150);
}


        </style>
    </head>
    <body>
<?php
    include("../conn.php");
    if(isset($_GET['table'])){
        $TABLE_NAME = $_GET['table'];
    }
    $condition = $_POST['choose'];
    $TARGET = $_POST['search-content'];
    $query = "select * from $TABLE_NAME where $condition = '$TARGET'";  
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $table_row_names = array();
    $table_row_num = mysqli_num_fields($res);
    for($i=0 ;$i < $table_row_num ;$i++){ //用一个数组存储所有列的名字
        $table_each_row = mysqli_fetch_field($res); //获取第i个列名字
        array_push($table_row_names,$table_each_row->name); //添加数组到尾部
    }

?>
        <div class="headlogo"><?php echo $TABLE_NAME ?></div>
        <div class="home-button">
            <a href="../show_schema.php">HOME</a>
        </div>
        <div class="dept-box">
            <table class="dept-table" 
                    cellpadding="5px" cellspacing="5px"
                    border="5" >
                <tr>
<?php
        for($i=0 ;$i < $table_row_num ;$i++){
            echo "<th>$table_row_names[$i]</th>";
        }
?>
                    <th>ADD</th>
                    <th>DELETE</th>
                </tr>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
            method='post'>




<?php
    $row = mysqli_num_rows($res);    //如果查询成功这里返回真否则为假
    if($row){  //在这里输出整张数据表!!!
        for($i = 0 ;$i < $row ;$i++){
            $dbrow=mysqli_fetch_array($res); //获取每一行的段数据
            $data_each_row = array();//用来存储每一行的段数据
            echo "<tr>";
            for($j = 0 ;$j < $table_row_num ;$j++){
                array_push($data_each_row,$dbrow[$table_row_names[$j]]);
                echo "<td>$data_each_row[$j]</td>";//输出某一行的段数据
            }
            echo "
            <td><a href=\"edit_dat.php?id=$data_each_row[0]&table=$TABLE_NAME\">修改</a></td>
            <td><a href=\"delete_dat.php?id=$data_each_row[0]&table=$TABLE_NAME\" 
                onclick=\"return confirm('确定删除吗？');\">删除</a></td> 
            </tr>
            ";
        }
    }
?> 

        </form>

            </table>

        </div>
    </body>
</html>