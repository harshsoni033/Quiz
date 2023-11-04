<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>

    <head>
        <title>Questions</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="ques_style.css"/>
    </head>
    <body>
        <form action="#" method="post">
        <div class="box">
            <div class="input-question">
                <label>Question : </label>
                <textarea name="question"  ></textarea>
            </div>

            <div class="input-option">
                <label>Option1 : </label>
                <input type="text" name="option[1]">
            </div>
            <div class="input-option">
                <label>Option2 : </label>
                <input type="text" name="option[2]">
            </div>
            <div class="input-option">
                <label>Option3 : </label>
                <input type="text" name="option[3]">
            </div>
            <div class="input-option">
                <label>Correct ans : </label>
                <input type="text" name="correct">
            </div>

            <div class="input-button">
                <input type="reset" name="reset" value="Reset">
                <input type="submit" name="submit" value="Submit">
            </div>

        </div>
        </form>
        
        <?php
            include 'db_connect.php';
            //ques_txt	quiz_id

            if(isset($_POST['submit']))
            {
                extract($_POST);
                $quizid='1';
                $insert="insert into tbl_question(ques_txt,quiz_id) values('$question','$quizid');";
                if(mysqli_query($conn, $insert))
                {
                    $select="select * from tbl_question order by ques_id desc limit 1 ";
                    $result=mysqli_query($conn, $select);
                    $row=mysqli_fetch_array($result);
                    $i=1;
                    while($i<4)
                    {
                        $insert2="insert into tbl_question_option(option_txt,ques_id,is_right) values('$option[$i]','".$row['ques_id']."','0');";
                        mysqli_query($conn, $insert2);
                        $i++;
                    }
                    $insert3="insert into tbl_question_option(option_txt,ques_id,is_right) values('$correct','".$row['ques_id']."','1');";
                    mysqli_query($conn, $insert3);
                }
            }




        ?>

    </body>

</html>