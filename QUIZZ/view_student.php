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
         $userid=$_GET['id'];
         $select="SELECT u.user_id,u.name,u.username,u.password,c.class_name from tbl_user u INNER JOIN tbl_student s on u.user_id=s.user_id INNER JOIN tbl_class c on c.class_id=s.class_id WHERE u.user_id='$userid';";
         $userdata= mysqli_query($conn,$select);      
         $abc= mysqli_fetch_array($userdata);
         $class_result=mysqli_query($conn,'select * from tbl_class;');
    ?>
        <div class="container">
        <div class="form register">
            <form action="view_student.php" method="post">
                <h2>Sign in</h2>
                <div class="inputBox">    
                    <input type="hidden" name="user_id" value="<?php echo $abc['user_id']; ?>" />
                    <input type="text" name="name" value="<?php echo $abc['name']; ?>" required="required">
                    <i class="fa-regular fa-envelope"></i> 
                    <span>Name</span>
                </diV>
                
                <div class="inputBox">
                    <input type="text" name="username" value="<?php echo $abc['username']; ?>" required="">
                    <i class="fa-regular fa-envelope"></i> 
                    <span>Username</span>
                </div>
                
                <div class="inputBox">
                    <input type="password" name="password" value="<?php echo $abc['password']; ?>" required="required">
                    <i class="fa-solid fa-lock"></i>
                    <span>Password</span>
                    <i id="hide1" class="fa-solid fa-eye eye" onclick="myFunction()"></i>
                    <i id="hide2" class="fa-solid fa-eye-slash eye" onclick="myFunction()"></i> 
                </div>
                
                <div class="form-group">
                    <select name="class">
                <!--<option value="" selected="selected"></option>-->
                <?php
                if(mysqli_num_rows($class_result)> 0)
                {
                    while ($crow = mysqli_fetch_array($class_result))
                    {
                        if($abc['class_name']==$crow['class_name'])
                        {
                            echo "<option value='".$crow['class_id']."' selected='selected' >".$crow['class_name']."</option>";
                        }
                        else 
                        {
                            echo "<option value='".$crow['class_id']."' >".$crow['class_name']."</option>";
                        }                       
                    }
                }
                ?>
            </select>
                </div>

                <div class="inputBox">
                    <input type="submit" name="update" value="Update">
                </diV>
            </form>
        </div>
    </div>

    <?php
   
    if (isset($_POST['update'])) {
        extract($_POST);
        $update="UPDATE tbl_user SET name='$name',username='$username',password='$password' WHERE user_id='$user_id';";
        $update1="UPDATE tbl_student SET class_id='$class' WHERE user_id='$user_id';";
        if(mysqli_query($conn,$update) && mysqli_query($conn, $update1))
        {
            header('location:student.php');
        }
        
        
    }
    ?>
</body>


</html>