<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
        <title>表名列表</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" type="text/css" href="style_cus.css" charset="UTF-8"> -->
        <style type="text/css">
body{
    text-align: center;
    background-image: url("../img/Italy.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
}
.headlogo{
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
    margin-top: 35px;
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
#submit-but{
    font-size: 14px;
    background-color: rgb(36, 131, 194);
    transition-duration: 0.4s;
    border:1.5px solid antiquewhite;
}
#submit-but:hover{
    background-color: rgb(21, 110, 170);
}
#cancel-but{
    font-size: 14px;
    background-color: rgb(223, 62, 137);
    transition-duration: 0.4s;
    border:1.5px solid antiquewhite;
}
#cancel-but:hover{
    background-color: rgb(190, 34, 107);
}
.add-button{
    margin-top:15px;
}
.add-button form input{
    padding:2px 12px 2px;
    background-color:antiquewhite;
    border:1px solid rgb(13, 56, 59);
    border-radius:6px;
    font-size:20px;
    font-weight: bold;
    text-decoration:none;
    color:rgb(13, 56, 59);
    transition-duration:0.6s;
    cursor: pointer;
}
.add-button input:hover{
    padding:2px 18px 2px;
}

/* 搜索栏cSS框架 */
.search-box select{
    margin-top:7px;
    margin-right:10px;
    background-color:antiquewhite;
    border:1.5px solid rgb(13, 56, 59);
    border-radius:4px;
    height:25px;
    font-size:16px;
}

.search-bar {
    border:1.5px solid rgb(13, 56, 59);
    position: absolute;
    display:inline-block;
    background: antiquewhite;
    height: 20px;
    border-radius: 40px;
    padding: 8px;
}

.search-btn {
    color: rgb(13,56,59);
    float: right;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border:0px;
    cursor: pointer;
    background: antiquewhite;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.6s;
    text-decoration: none;
}

.search-txt {
    border: none;
    background: none;
    outline: none;
    float: left;
    padding: 0;
    color: white;
    font-size: 16px;
    transition: 0.4s;
    line-height: 20px;
    width: 0;
}

.search-bar:hover>.search-txt {
    width: 200px;
    padding: 0 6px;
}
.search-txt:hover{
    background:rgb(211, 199, 184);
}
        </style>


    </head>
    <body>
        <div class="headlogo">CUSTOMER</div>

        <div class="home-button">
            <a href="../show_schema.php">HOME</a>
        </div>


        <div class="dept-box">
            <div class="search-box">
                <form action="search_cus.php" method="post">
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
    include("../conn.php");
    $query = "select * from customers";  
    $res = mysqli_query($conn, $query) or die(mysql_error());
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
            <td><a href=\"edit_cus.php?id=$cid\">修改</a></td>
            <td><a href=\"delete_cus.php?id=$cid\" 
                onclick=\"return confirm('确定删除吗？');\">删除</a></td> 
        </tr>
    ";
        }
    }
?> 

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
            method='post'>
<?php


    
    $change="change";
    if ($_SERVER["REQUEST_METHOD"] == "POST") { //加上这个之后就可以消除notice字段

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
                <td><a href='' id='cancel-but'> 取消</a></td>
                </tr>
                ";
            }
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
            "<script language=javascript>window.location.href='show_cus.php';</script>";
        }
        else{
            echo 
            "<script language=javascript>window.alert('增添失败,请返回');
            window.location.href='show_cus.php';</script>";

        }

    }   
?>
            </form>

            </table>
            <div class="add-button">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
                        method="post">
                        <input type="submit" name="plus-syn" value="+">
                </form>
            </div>
        </div>
    </body>
</html>