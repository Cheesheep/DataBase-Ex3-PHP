<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>表名列表</title>
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" type="text/css" href="style_cus.css"> -->
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


        </style>
    </head>
    <body>
        <div class="headlogo">CUSTOMER</div>
        <div class="home-button">
            <a href="../show_schema.php">HOME</a>
        </div>
        <div class="dept-box">
            <table class="dept-table" 
                    cellpadding="5px" cellspacing="5px"
                    border="5" >
                <tr>
                    <th>CID</th>
                    <th>NAME</th>
                    <th>CITY</th>
                    <th>MADE</th>
                    <th>LAST-TIME</th>
                </tr>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
            method='post'>




<?php
    include("../conn.php");
    $condition = $_POST['choose'];
    $TARGET = $_POST['search-content'];
    $query = "select * from customers where $condition = '$TARGET'";  
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
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