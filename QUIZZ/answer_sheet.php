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

    $sel_quiz = mysqli_query($conn, "select * from tbl_quiz_list where quiz_id='1'");
    $quiz = mysqli_fetch_array($sel_quiz);
    ?>
    <form action="submit_answer.php" method="post">
        <h1>
            <?php echo $quiz['title'].$quiz['quiz_id']; ?>
        </h1>
        <input type="hidden" name="user_id" value="1">
        <input type="hidden" name="quiz_id" value="<?php echo $quiz['quiz_id'] ?>">
        <input type="hidden" name="qpoints" value="1">
        <?php
        $question = mysqli_query($conn, "select * from tbl_question where quiz_id='" . $quiz['quiz_id'] . "';");
        $i = 1;
        while ($row = mysqli_fetch_array($question)) {
            $opt = mysqli_query($conn, "select * from tbl_question_option where ques_id='" . $row['ques_id'] . "'; ");
            ?>
            <div>
                <strong>
                    <?php echo "<br>" . ($i++) . ").";
                    echo $row['ques_txt']; ?>
                </strong>
                <input type="hidden" name="question_id[<?php echo $row['ques_id'] ?>]"
                    value="<?php echo $row['ques_id'] ?>">
                <br>
                <?php while ($orow = mysqli_fetch_array($opt)) { ?>
                    <input type="radio" name="option_id[<?php echo $row['ques_id']; ?>]" value="<?php echo $orow['option_id']; ?> "> <?php echo $orow['option_txt'] ?>
                    <br>
                <?php }
        } ?>
        </div>

        <div>
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

</body>

</html>