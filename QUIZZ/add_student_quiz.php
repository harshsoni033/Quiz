<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'db_connect.php';
    $class_result = mysqli_query($conn, 'select * from tbl_class;');
    ?>

    <form action="" method="post">
        <div class="form-group">
            <label>class</label>
            <select name="class">
                <?php
                if (mysqli_num_rows($class_result) > 0) {
                    while ($row = mysqli_fetch_array($class_result)) {
                        echo "<option value='" . $row['class_id'] . "' >" . $row['class_name'] . "</option>";
                    }
                }
                ?>
            </select>
            <div>
                <input type="submit" name="submit" value="Submit" />
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        extract($_POST);
        $select="select * from tbl_student where class_id='$class'";
        $result=mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $insert="insert into tbl_quiz_student_list(quiz_id,user_id) values('1','".$row['user_id']."')";
                mysqli_query($conn, $insert);
            }
        }

    }
    ?>
</body>

</html>