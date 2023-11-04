<?php
    
    $host="localhost";
    $username="root";
    $password= "";
    $dbname= "myquizz";
    $conn=mysqli_connect($host,$username,$password,$dbname);

    if(mysqli_connect_errno())
    {
        echo "Database is not connected!!!".mysqli_connect_error();
    }
?>