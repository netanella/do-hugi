<?php

if (isset($_POST['deleteUser'])) {
    $con = mysqli_connect('localhost', 'root', '', 'dohugi');
    mysqli_set_charset($con,'utf8');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    $email=$_POST['email'];
    $password=$_POST['pwd'];

    $query = "SELECT * FROM users where Email='$email' and Password='$password'";

    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result)==0){
        echo "Log in failed. please try again";
    }
    else {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['firstname'] = $row['First_Name'];
        $_SESSION['photo'] = $row['Photo'];
        header('Location:hugSearch.php');
    }

    //echo("Error description: " . mysqli_error($con));
}

mysqli_close($con);

?>