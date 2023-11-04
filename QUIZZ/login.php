<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="Script/login_new_style.css"/>
</head>

<body>
    <div class="container">
        <div class="form register">
            <form action="login.php" method="post">
                <h2>Sign in</h2>
                <div class="inputBox">
                    <input type="text"  name="username"  <?php if (isset($_POST["login"])) { echo "value='$username'";} ?>  required="reguired">
                    <i class="fa-regular fa-envelope"></i> 
                    <span>Email or username</span>
                </diV>
                <div class="inputBox">
                    <input type="password"  name="password" <?php if (isset($_POST["login"])) { echo "value='$password'";} ?> required="reguired" id="myInput">
                    <i class="fa-solid fa-lock"></i>
                    <span>Password</span>
                    <i id="hide1" class="fa-solid fa-eye eye" onclick="myFunction()"></i>
                    <i id="hide2" class="fa-solid fa-eye-slash eye" onclick="myFunction()"></i> 
                </diV>

                <div class="inputBox">
                    <input type="submit" name="login" value="Login">
                </diV>
                <p>Already a member?<a href="Registration.php"> Log in</a></p>
            </form>
        </div>
    </div>

    <?php
        include 'db_connect.php';

        if(isset($_POST['login']))
        {
            extract($_POST);    
            $select="select * from tbl_user where username='$username' and password='$password' ";
            $result=mysqli_query($conn,$select);
            if(mysqli_num_rows($result)> 0)
            {
                $row= mysqli_fetch_array($result);
                session_start();
                $_SESSION["user_id"] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                header("location:home.php");
            }
        }
    ?>
</body>

</html>