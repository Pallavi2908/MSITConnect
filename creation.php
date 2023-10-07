<?php
    include 'connection.php';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $enrollno=$_POST['enrollno'];
        $username=$_POST['username'];
        $pwd=$_POST['pwd'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $stream=$_POST['stream'];
        $DOB=$_POST['DOB'];
        $batch=$_POST['batch'];
        if(strlen($pwd)<5)
        {
            echo "Password too weak";
        }else{
            $check_username_query= "SELECT * FROM `students_data` WHERE username='$username'";
            $check_email_query= "SELECT * FROM `students_data` WHERE email='$email'";
            $check_enrollno_query= "SELECT * FROM `students_data` WHERE Enroll_no='$enrollno'";
            $result=mysqli_query($con, $check_username_query);
            $result2=mysqli_query($con, $check_email_query);
            $result3=mysqli_query($con,$check_enrollno_query);

            if(mysqli_num_rows($result)>0 OR mysqli_num_rows($result2)>0 OR mysqli_num_rows($result3)>0) {
                echo "Details already in database,try again...";
                header("refresh:5;url=registration.html"); 
            }
            else{
                $hashed_pwd=password_hash($pwd,PASSWORD_DEFAULT);
                $sql="INSERT INTO `students_data`(password,Enroll_no,Username,email,phone_no,Stream,DOB,Batch) VALUES('$hashed_pwd','$enrollno','$username','$email', '$phone','$stream','$DOB','$batch')";
                echo $sql;
                if(mysqli_query($con,$sql)){
                    echo "Student has been successfully inserted into database";
                    header("refresh:5;url=admin_dashboard.html"); 
                }else{
                    echo "Error: ".mysqli_error($con);
                } 
                
            }



        }
    }
    mysqli_close($con);
?>
