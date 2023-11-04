<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        include 'db_connect.php';
        
        $userid=$_GET['id'];
        $delete="delete from tbl_student where user_id='$userid';";
        $delete1="delete from tbl_user where user_id='$userid';";
        if(mysqli_query($conn, $delete) && mysqli_query($conn,$delete1))
        {
            header('location:student.php');
        }
        ?>
    </body>
</html>
