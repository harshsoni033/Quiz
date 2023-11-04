<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include('db_connect.php') ?>
    <form action="create_quiz.php" method="post">
                <div class="modal-body">
                    <div id="msg"></div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" name="id" />
                        <input type="text" name="title" required="required" />
                    </div>

                    <div class="form-group">
                        <label>Points per question</label>
                        <input type="nember" name="qpoints" required="" />
                    </div>

                    <div class="form-group">
                        <label>Faculty</label>
                        <select name="user_id" required="required" />
                        <?php
                        $select = "select * from tbl_user where user_type=2";
                        $result = mysqli_query($conn, $select);
                        if (mysqli_num_rows($result) > 0) 
                        {
                            while ($row = mysqli_fetch_array($result)) 
                            {
                                echo "<option value='".$row['user_id']."'>".$row['name']."</option>";
                            }
                        }
                        ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button name="save"> Save</button>
        </div>
    </form>

    <?php

    if (isset($_POST['save'])) {
        extract($_POST);
        $insert = "insert into tbl_quiz_list(title,ques_point,user_id) values('$title','$qpoints','$user_id')";
        if(mysqli_query($conn, $insert)) {
            echo "Insert successfully!!!";
        }
    }
    ?>
</body>

</html>