
    <?php       
        include 'db_connect.php';
        extract($_POST);
        $points=0;
        foreach($question_id as $key => $value)
        {
             $is_right=0;
             if(isset($option_id[$key]))
                {
                    $is_right_select=mysqli_query($conn,"select * from tbl_question_option where option_id='".$option_id[$key]."' ");
                    $row= mysqli_fetch_array($is_right_select);
                    $is_right=$row['is_right'];
                    // $insert="insert into tbl_answer(user_id,quiz_id,ques_id,option_id,is_right) values('$user_id','$quiz_id','$question_id[$key]','$option_id[$key]','$is_right');";
                    // mysqli_query($conn,$insert);
    
                    if($is_right >0)
                    {
                        $points++;
                    }
                }   
                
        }
            $score=$points*$qpoints;
            $total=count($question_id)*$qpoints;
            // $insert2=mysqli_query($conn,"insert into tbl_history(quiz_id,user_id,score,total_score) values('$quiz_id','$user_id','$score','$total'); ");
            echo "Score is $score / $total"."<br>"; 
    ?>
    
