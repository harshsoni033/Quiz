<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    </head>
    <?php include('header.php') ?>
   
    <title>Quiz List</title>
</head>
<body>
    <?php include('db_connect.php') ?>
    <?php include('nav_bar.php') ?>

    <div class="container-fluid admin">
        <div class="col-md-12 alert alert-primary">Quiz List</div>
        <button class="btn btn-primary bt-sm" ><i class="fa fa-plus"></i> Add New</button>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id='table'>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Class</th>
                            <th>Point per Items</th>
                            <?php if ($_SESSION['user_type'] == 1){
                            echo "<th>Faculty</th>";                            
                            } 
                            ?>                           
                            <th>Action</th>
                        </tr>
                        <?php
                            $quiz_list= mysqli_query($conn,"select q.*,u.name from tbl_quiz_list q inner join tbl_user u on q.user_id=u.user_id;");
                            
                            if(mysqli_num_rows($quiz_list))
                            {
                                while ($row= mysqli_fetch_array($quiz_list))
                                {?>
                                    <tr>
                                        <td><?php echo $row['quiz_id']; ?></td>
                                        <td><?php echo $row['title'];  ?></td>
                                        <td><?php echo $row['title'];  ?></td>
                                        <td><?php echo $row['ques_point'];  ?></td>
                                        <td><?php echo $row['name'];  ?></td>
                                        <td><b>Nothing</b></td>
                                    </tr>
                                <?php                                                                                                                             
                                }
                            }
                        ?>                       
                </table>
            </div>
        </div>
    </div>
</body>
</html>