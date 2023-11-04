<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="Script/regis_style.css"/>
</head>

<body>
    <?php
         include 'db_connect.php';         
         $class_result=mysqli_query($conn,'select * from tbl_class;');
    ?>
        <div class="container">
        <div class="form register">
            <form action="#" method="post">
                <h2>Sign in</h2>
                <div class="inputBox">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="uid" />
                    <input type="hidden" name="user_type" value='3' />
                    <input type="text" name="name" required="required">
                    <i class="fa-regular fa-envelope"></i> 
                    <span>Name</span>
                </diV>
                
                <div class="inputBox">
                    <input type="text" name="username" required="">
                    <i class="fa-regular fa-envelope"></i> 
                    <span>Username</span>
                </div>
                
                <div class="inputBox">
                    <input type="password" name="password" required="required">
                    <i class="fa-solid fa-lock"></i>
                    <span>Password</span>
                    <i id="hide1" class="fa-solid fa-eye eye" onclick="myFunction()"></i>
                    <i id="hide2" class="fa-solid fa-eye-slash eye" onclick="myFunction()"></i> 
                </div>
                
                <div class="form-group">
                    <select name="class">
                        <option value="none" selected="selected">  ----  Select class --- </option>
                    <?php
                    if(mysqli_num_rows($class_result)> 0)
                    {
                        while ($row = mysqli_fetch_array($class_result))
                        {
                            echo "<option value='".$row['class_id']."' >".$row['class_name']."</option>";
                        }
                    }
                    ?>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="submit" name="Save" value="Save">
                </diV>
            </form>
        </div>
    </div>

    <?php
   
    if (isset($_POST['Save'])) {
        extract($_POST);
        $select = "select * from tbl_user where username='$username';";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            echo "User is already exist!!!";
        } else {
            $insert1 = "insert into tbl_user(name,user_type,username,password) values('$name','$user_type','$username','$password') ";
            if (mysqli_query($conn, $insert1)) {
                $select1 = "select * from tbl_user where username='$username' ";
                $result = mysqli_query($conn, $select1);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $insert2 = "insert into tbl_student(user_id,class_id) values('" . $row['user_id'] . "','$class'); ";
                    if(mysqli_query($conn, $insert2))
                    {
                        header('location:student.php');
                    }
                }
            }
        }
    }
    ?>
</body>


</html>