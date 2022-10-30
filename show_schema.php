<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
        <title>表名列表</title>
        <style type="text/css">
            body{
                text-align: center;
                background-image: url("img/Italy.jpg");
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
            .schema-box{
                margin: 0 auto;
                margin-top: 50px;

            }
            .table01{
                display: inline-block;
                font-size: 30px;
                color: antiquewhite;
            }
            .table01 td{
                background-color: rgb(85, 146, 146);
                border-radius: 10px;
                border: 5px solid;
            }
            
            a{
                text-decoration: none;
                color: antiquewhite;
            }
        </style>
    </head>
    <body>


        <div class="headlogo">请选择要查看的表</div>
        <div class="schema-box">
            <table class="table01" cellspacing="20px" cellpadding="5px">
                <tr>
                    <td>customers</td>
                    <td class="check"><a href="./DataBase/show_dat.php?table=customers">查看</a></td>
                </tr>
                <tr>
                    <td>emp</td>
                    <td class="check"><a href="./DataBase/show_dat?table=employees">查看</a></td>
                </tr>
                <tr>
                    <td>products</td>
                    <td class="check"><a href="./DataBase/show_dat?table=products">查看</a></td>
                </tr>
            </table>
        </div>
    </body>
</html>