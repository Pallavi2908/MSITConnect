<?php
    require 'connection.php';
    require 'C:\xampp\htdocs\smart_sampann\vendor\autoload.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $enrollno=$_POST['enrollno'];
        $pwd=$_POST['pwd'];
        $pwd = mysqli_real_escape_string($con, $pwd);
        $enrollno = mysqli_real_escape_string($con, $enrollno);
         // Retrieve the stored hashed password for the given username
        $retrieve_password_query = "SELECT password FROM `students_data` WHERE Enroll_no = '$enrollno'";
        // echo $retrieve_password_query."<br>";
        $result = mysqli_query($con, $retrieve_password_query);
        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            $password_from_db = $row['password'];
            echo "Password from DB: " . $password_from_db . "<br>";
        
            // Compare the entered password with the hashed
            if (password_verify($pwd, $password_from_db))
            {
                header("Location: student_dashboard.php?enrollment=" . $enrollno);
                session_start();
                $_SESSION['enrollment_number'] = $enrollno;
                exit();
            } else {
                echo "NOT FOUND";
                echo mysqli_error($con);
            }
        }
        
    }
    mysqli_close($con);
?>


