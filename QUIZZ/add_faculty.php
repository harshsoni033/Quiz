<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="add_faculty.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="id" />
            <input type="hidden" name="uid" />
            <input type="hidden" name="user_type" value='2' />
            <input type="text" name="name" required="required" />
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" required="" />
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required="" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required="required" />
        </div>

        <button name="save"> Save</button>

    </form>

    <?php
        include 'db_connect.php';

        if(isset($_POST['save']))
        {
            extract($_POST);
            $select="select * from tbl_user where username='$username'";
            $result=mysqli_query($conn, $select);
            if(mysqli_num_rows($result)> 0)
            {
                echo "User is already exist!!!";
            }
            else
            {
                $insert1="insert into tbl_user(name,user_type,username,password) values('$name','$user_type','$username','$password') ";
                if(mysqli_query($conn, $insert1))
                {
                   $select1="select * from tbl_user where username='$username' ";
                   $result=mysqli_query($conn, $select1);
                   if(mysqli_num_rows($result)> 0)
                   {
                    $row=mysqli_fetch_array($result);
                    $insert2="insert into tbl_faculty(user_id,subject) values('".$row['user_id']."','$subject'); ";
                    mysqli_query($conn, $insert2);
                   }
                }
            }
            
            
            
              
        }


    ?>
</body>

</html>