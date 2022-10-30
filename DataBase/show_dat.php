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
    $query = "select * from customers";  
    $res = mysqli_query($conn, $query) or die(mysql_error());
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
                    <option value="cid">cid</option>
                    <option value="cname">cname</option>
                    <option value="city">city</option>
                    <option value="visits_made">visits_made</option>
                    <option value="last_visit_time">last_visit_time</option>
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
                    <th>CID</th>
                    <th>NAME</th>
                    <th>CITY</th>
                    <th>MADE</th>
                    <th>LAST-TIME</th>
                    <th>ADD</th>
                    <th>DELETE</th>
                </tr>
<?php

    $row = mysqli_num_rows($res);    //如果查询成功这里返回真否则为假
    if($row){
        for($i = 0 ;$i < $row ;$i++){
            $dbrow=mysqli_fetch_array($res); //获取每一行的段数据
            $cid = $dbrow['cid'];
            $cname = $dbrow['cname'];
            $city = $dbrow['city'];
            $visits_made = $dbrow['visits_made'];
            $visits_time = $dbrow['last_visit_time'];

?>



 <?php  //插入到这里的表格当中
    echo "
        <tr>
            <td>$cid</td>
            <td>$cname</td>
            <td>$city</td>
            <td>$visits_made</td>
            <td>$visits_time</td>
            <td><a href=\"edit_dat.php?id=$cid&table=$TABLE_NAME\">修改</a></td>
            <td><a href=\"delete_dat.php?id=$cid&table=$TABLE_NAME\" 
                onclick=\"return confirm('确定删除吗？');\">删除</a></td> 
        </tr>
    ";
        }
    }
?> 

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
            method='post'>
<?php


    if(isset($_POST["plus-syn"]) == "+"){//显示要添加的新的信息
        echo "
        <tr>
            <td><input type='text' name='cid' id='in-text'></td>
            <td><input type='text' name='cname' id='in-text'></td>
            <td><input type='text' name='city' id='in-text'></td>
            <td><input type='text' name='visits_made' id='in-text'></td>
            <td>Current Time</td>
            <td><input type='submit' name='change'
                    value='确定' id='submit-but'></td>
            <td><a href='./show_dat?table=$TABLE_NAME' id='cancel-but'> 取消</a></td>
            </tr>
            ";
        }
    if(isset($_POST["change"]) == "确定"){ //在这里完成数据库的插入
        $cid=$_POST["cid"];
        $cname=$_POST["cname"];
        $city=$_POST["city"];
        $visits_made=$_POST["visits_made"];
        $visits_time=date("Y-m-d H:i:s");
        $query = "INSERT INTO customers (cid,cname,city,visits_made,last_visit_time)
         VALUES ('$cid','$cname','$city','$visits_made','$visits_time')";
        $result=mysqli_query($conn,$query) or die(mysqli_error($conn));
        
        if($result){
            echo 
            "<script language=javascript>window.location.href='show_dat.php';</script>";
        }
        else{
            echo 
            "<script language=javascript>window.alert('增添失败,请返回');
            window.location.href='show_dat.php';</script>";

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