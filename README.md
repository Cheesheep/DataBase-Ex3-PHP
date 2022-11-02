# PHP连接前后端（实验三）

---

## 实现思路

- **前端**：

  前端直接用php后缀名的文件写html，然后CSS可以写在外部文件，但是在外部文件的时候有时有些奇怪，不生效，所以暂时都写在php文件里面

- **后端**：

  后端采用php连接mysql数据库的方式，有少量JavaScript嵌入到php代码里面，主要采用的是在html代码中嵌入php语言的方式



## 代码结构

> 文件数量并不是很多，有关的页面可以说只有两个区别比较大的页面，剩下的都是一些增删改查的操作，因此从框架上先理解就会更容易弄明白

- 先说一下文件组成框架

  ![image-20221030103907217](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030103907217.png)

  show_schema.php作为主页面，然后主要的表的增删改查功能在文件夹**DataBase**里面

  ![image-20221030204346847](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030204346847.png)

  

  Database文件夹里面如下所示，最**主要**的界面还是**show_dat.php**，下面会有详细介绍

  其中`delete_dat.php `和` Dif_SQL.php`是没有前端渲染的，全是php代码做一些逻辑的处理和输出

  尤其是`Dif_SQL.php`文件主要作提供两个函数功能的作用，稍后会有介绍




---

## 网页＋代码详解：



### 1. **首页**（show_schema.php）：

  ![image-20221030103514277](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030103514277.png)

  在该页面有多个表可以选择，实际是跳转到**同一个**文件（show_dat.php）里面，但是点击不同的**查看**按钮的时候，传入的`$_GET`数据会不一样

  看如下html代码

  ~~~html
   <table class="table01" cellspacing="20px" cellpadding="5px">
                <tr>
                    <td class="check">
                        <a href="./DataBase/show_dat.php?table=customers">Customer</a>
                    </td>
                </tr>
                <tr>
                    <td class="check">
                        <a href="./DataBase/show_dat?table=employees">Emp</a>
                    </td>
                </tr>
  ~~~

  可以看到show_dat?后面的传入内容是不一样的，因此查询的表的内容其实也就可以灵活变动。

使用`$_GET`变量就可以在传入的文件中接受并且确定它的内容是什么，然后在php中就可以用这个变量动态的代替表名。

~~~php
    if(isset($_GET['table'])){ //如图接收变量
        $TABLE_NAME = $_GET['table'];
    }
~~~



---

### 2. 展示表的全部数据（show_dat.php）

![image-20221030211120870](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030211120870.png)

- 可以看到这个页面的内容还是挺丰富的，接下来将**从上到下**逐一介绍

#### 2.1 搜索栏(search_dat.php + show_dat.php)

> 首先来介绍一下最上面的搜索栏

- HTML框架

  这里用了form表单当中的`select`标签来提供选项，代码如下所示

  ![image-20221030211433528](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030211433528.png)

  这里嵌入了php语言，但是也挺好看懂的，其实就是通过for循环显示出多个选项，也就是对应的列名，这里的`table_row_num`就是列的个数，具体的获取方法这里就不展开了；

  只需要知道表名就可以找到对应的相关数据了，因此不同的表的`table_row_num`也是不一样的

  ![image-20221030212001544](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030212001544.png)

  如上图所示效果。选择好要搜索哪一列的内容后，将鼠标置于右边的搜索logo上，就会平滑展开出一个搜索栏，这里是用css3的`transition`的方式来实现动态效果。

  ![image-20221030212333120](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030212333120.png)

  填写搜索内容后点击右边的搜索按钮就会跳转到`search_dat.php`文件当中啦，这里我们假设选择cid 并且搜索c001。则会显示出来搜索到的唯一结果

  ![image-20221030212531480](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030212531480.png)

  然后我们可以大致看一下`search_dat.php`里面的内容是什么

  ![image-20221030214710302](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030214710302.png)

  先是最上面我们通过get方法获取表名，然后下面是通过post方法获得的`$condition`和`$TARGET`分别是在上一个页面中的选择框和搜索框的内容，也就是这张传过来的数据

  ![image-20221030212333120](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030212333120.png)

  接下来就是通过`$query`语句获取sql，有着限定条件，因此最后会输出特定范围搜索出来的行数据。



#### 2.1 查看和修改＋删除数据(edit_dat.php + show_dat.php)

> 接下来讲页面中最重要的内容

#### 修改数据

该图为show_dat.php

![image-20221030215427326](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030215427326.png)

- 点击其中一个**修改**按钮看看效果如何（下图是edit_dat.php页面）

![image-20221030215447319](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030215447319.png)

可以看到点击的对应的那一行变成了输入框，并且保留有原来的内容，不过cid也就是第一列的数据是无法修改的（为了安全起见）。

如果填写好了就可以点击确认，否则就可以**取消**，返回到show_dat.php的页面

- 看一下show_dat.php中**修改**按钮对应的代码

![image-20221030215648717](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030215648717.png)

看到前面输出的都是通过for循环显示的那一行的数据，然后点击按钮后，会跳转到edit_dat.php页面。

但是edit_dat.php页面的内容其实和show_dat.php大致是一样的，只是在点击了**修改**的那一行改成了input输入框，具体代码可参考源码。



#### 删除数据(delete_dat.php)

>  删除的话比较简单,点击删除按钮后会跳转到delete_dat.php文件，删除后会自动返回到show_dat.php页面当中

- 点击删除时会有一个js代码编写的提示是否删除

![image-20221030220231439](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030220231439.png)

- delete_dat.php对应代码，比较简短

~~~php
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
    window.location.href='show_dat.php?table=$TABLE_NAME';</script>";//返回
} 
?>
~~~

#### 2.3 增加数据(show_dat.php)

> 增加数据这里的代码，为了文件更加简洁方便，我就也写在了show_dat.php当中了。

- 先演示一下效果，点击 ‘ + ’号后会在最下方增加一行多个input输入框

![image-20221030220643756](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030220643756.png)

- 关于这部分的php逻辑代码如下所示

![image-20221030220820845](https://gitee.com/cheesheep/typora-photo-bed/raw/master/Timg/image-20221030220820845.png)

- 第一个if语句是触发点击了 ‘ + ’按钮的效果，然后就会输出一行input语句

  ~~~php+HTML
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
  ~~~

  

- 第二个if 语句则是点击了红色的**确定**按钮之后会触发的效果

  ~~~php+HTML
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
  ~~~

  添加成功后就会返回到原来的页面，就可以看到最下面会多了一行数据出来。

---

### 总结

- 至此就介绍完了整个网页的大致组成了，更加细致的可以去GitHub上面找我的源代码https://github.com/Cheesheep/DataBase-Ex3-PHP。

- 打开show_schema.php即可正常食用。哦前提是数据库连接要正确，稍微改一下conn.php的内容就可以了

- 我调试的时候用的是wampserver自带的mysql数据库以及php，并且是在它的www根目录下打开的php界面，如果不会用的话可以参照我的方法，先下个wampserver吧！！

  

#### 最后说下感想（大概写了一周的代码吧）：

 我感觉最难的一个部分就是最后解决代码重用性的问题，一开始很多参数都是写死的， 框架也是写死的，但写到后面就会发现很多地方的代码其实是重复的，如果有m张表那我还得一个个页面的复制，然后改m次里面的参数，那实在是太花费精力了。

 因此经过一番思考之后，发现只要每个页面中有表名存在，并且可以传到每一个下一个要去的页面就可以了，然后所有数据就只需要根据表名就都可以通过php代码的出来并且显示到前端上面，比较难以复用的就是mysql语句的编写，因此mysql语句则是有多少张表则写了多少个相似的mysql语句，但是在操作的参数方面会有些许不同。

​    最后，虽然本次实验花费了很多时间，但算是第一次完整接触了前后端的网页制作，个人认为是学到了很多东西，打开了后端的大门，仍有许多需要学习的地方。
