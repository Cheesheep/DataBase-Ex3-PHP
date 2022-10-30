
<?php
// 这个文件用来区分不同的sql语句，因为对于不同的数据库，插入的数据不一样，因此写的sql会不一样
// 打算用switch case 的方法来区分

/* 函数功能：对于不同的数据表，有不同的插入语句以及插入元素
    nums：是指总共要插入多少个数据
    TABLE_NAME: 对应的是哪个数据表
    row_names: 对应当前这个表的所有列名数组

*/

function insert_SQL($nums,$TABLE_NAME,$row_names){
    $row_data = array();//用来存储获取到的列数据
    $query = "";//定义sql语句
    for($i=0 ;$i < $nums;$i++){
        array_push($row_data,$_POST[$row_names[$i]]); //将获取的post数据放入这个数组当中
    }

    switch($TABLE_NAME){
        case 'customers':
         $query = "INSERT INTO $TABLE_NAME
             VALUES ('$row_data[0]','$row_data[1]','$row_data[2]','$row_data[3]',
                '$row_data[4]')"; 
            break;
        case 'employees':
            $query = "INSERT INTO $TABLE_NAME
                VALUES ('$row_data[0]','$row_data[1]','$row_data[2]')"; 
            break;
        case 'logs'://这个的id是自增长的所以不用算上第一个
            $query = "INSERT INTO $TABLE_NAME (who,time,table_name,operation,key_value)
                VALUES ('$row_data[1]','$row_data[2]','$row_data[3]',
                '$row_data[4]','$row_data[5]')"; 
            break;
        case 'products':
            $query = "INSERT INTO $TABLE_NAME
                VALUES ('$row_data[0]','$row_data[1]','$row_data[2]',
                '$row_data[3]','$row_data[4]','$row_data[5]','$row_data[6]')"; 
            break;        
        case 'purchases':
            $query = "INSERT INTO $TABLE_NAME
                VALUES ('$row_data[0]','$row_data[1]','$row_data[2]',
                '$row_data[3]','$row_data[4]','$row_data[5]','$row_data[6]')"; 
            break;  
        case 'suppliers':
            $query = "INSERT INTO $TABLE_NAME
                VALUES ('$row_data[0]','$row_data[1]','$row_data[2]',
                '$row_data[3]')"; 
            break;    
    }

    return $query;
}
/* 函数功能：更新不同的数据库需要不同的sql语句
    nums：是指总共要插入多少个数据
    TABLE_NAME: 对应的是哪个数据表
    row_names: 对应当前这个表的所有列名数组

*/
function Update_SQL($nums,$TABLE_NAME,$row_names){
    $row_data = array();//用来存储获取到的列数据
    $query = "";//定义sql语句
    for($i=0 ;$i < $nums;$i++){
        array_push($row_data,$_POST[$row_names[$i]]); //将获取的post数据放入这个数组当中
    }

    switch($TABLE_NAME){
        case 'customers':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]',
            $row_names[3]='$row_data[3]',$row_names[4]='$row_data[4]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;
        case 'employees':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;
        case 'logs':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]',
            $row_names[3]='$row_data[3]',$row_names[4]='$row_data[4]',$row_names[5]='$row_data[5]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;
        case 'products':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]',
            $row_names[3]='$row_data[3]',$row_names[4]='$row_data[4]',$row_names[5]='$row_data[5]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;
        case 'purchases':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]',
            $row_names[3]='$row_data[3]',$row_names[4]='$row_data[4]',$row_names[5]='$row_data[5]',
            $row_names[6]='$row_data[6]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;
        case 'suppliers':
            $query = "UPDATE $TABLE_NAME SET $row_names[1]='$row_data[1]',$row_names[2]='$row_data[2]',
            $row_names[3]='$row_data[3]'
            WHERE $row_names[0]= '$row_data[0]'
            "; 
            break;            
    }
    return $query;
}