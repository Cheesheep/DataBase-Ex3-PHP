<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
        <title>表名列表</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="style_dat.css" charset="UTF-8">


    </head>

<?php
    include("../conn.php");
    if(isset($_GET['table'])){
        $TABLE_NAME = $_GET['table'];
    }
    
    $query = "SELECT * FROM $TABLE_NAME";  
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $table_row_names = array();
    $table_row_num = mysqli_num_fields($res);
    for($i=0 ;$i < $table_row_num ;$i++){ //用一个数组存储所有列的名字
        $table_each_row = mysqli_fetch_field($res); //获取第i个列名字
        array_push($table_row_names,$table_each_row->name); //添加数组到尾部
    }
?>
    <body>
        <div class="headlogo"><?php echo $TABLE_NAME ?></div>

        <div class="home-button">
            <a href="../show_schema.php">HOME</a>
        </div>


        <div class="dept-box">
            <div class="search-box">
                <form action="<?php echo "search_dat.php?table=$TABLE_NAME";?>" method="post">
                    <select name="choose" id="">

<?php
        for($i=0 ;$i < $table_row_num ;$i++){
            echo "<option value='$table_row_names[$i]'>$table_row_names[$i]</th>";
        }
?>
                    </select>
                    <div class= "search-bar">
                        <input type="text" name="search-content" class="search-txt" placeholder="请输入搜索内容">
                        <button type="submit" class="search-btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>        
            <table class="dept-table" 
                    cellpadding="5px" cellspacing="5px"
                    border="5">
                <tr>
<?php
    for($i=0 ;$i < $table_row_num ;$i++){
        echo "<th>$table_row_names[$i]</th>";
    }
?>
                    <th>ADD</th>
                    <th>DELETE</th>
                </tr>
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


<!--   ----------------------   下面是 添加 表单的内容   -->

            <form action="<?php echo "show_dat.php?table=$TABLE_NAME";?>"
            method='post'>
<?php


    if(isset($_POST["plus-syn"]) == "+"){//显示要添加的新的信息
        echo "<tr>";
        for($i=0 ;$i < $table_row_num;$i++){
            echo "<td><input type='text' name='$table_row_names[$i]' id='in-text'></td>";
        }
        echo "
        <td><input type='submit' name='change'
                value='确定' id='submit-but'></td>
        <td><a href='./show_dat?table=$TABLE_NAME' id='cancel-but'> 取消</a></td>
        </tr>
        ";
    }
    if(isset($_POST["change"]) == "确定"){ //在这里完成数据库的插入
        include("Dif_SQL.php");//引入用于数据库操作的文件
        $query = insert_SQL($table_row_num,$TABLE_NAME,$table_row_names);//完成插入语句

        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        
        if($result){
            echo 
            "<script language=javascript>window.location.href='show_dat.php?table=$TABLE_NAME';</script>";
        }
        else{
            echo 
            "<script language=javascript>window.alert('增添失败,请返回');
            window.location.href='show_dat.php?table=$TABLE_NAME';</script>";

        }
    }   
?>
            </form>

            </table>
            <div class="add-button">
                <form action="<?php echo "show_dat?table=$TABLE_NAME"; ?>"
                        method="post">
                        <input type="hidden" name="pass-table-name" value="$TABLE_NAME">
                        <input type="submit" name="plus-syn" value="+">
                </form>
            </div>
        </div>
    </body>
</html>