<?php

if (isset($_POST['submit5'])) {

    $con = mysqli_connect('localhost', 'root', '', 'dohugi');
    mysqli_set_charset($con,'utf8');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $about=$_POST['about'];
    $hobbies=$_POST['hobbies'];

    $query = "UPDATE USERS SET First_Name='$firstname', Last_Name='$lastname', About='$about', Hobbies='$hobbies' 
                WHERE Email='$email'";

    mysqli_query($con, $query);

    echo "Details were updated successfully";

    //echo("Error description: " . mysqli_error($con));
}


if (isset($_POST['submit6'])) {

    $con = mysqli_connect('localhost', 'root', '', 'dohugi');
    mysqli_set_charset($con,'utf8');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    session_start();
    $email=$_SESSION['email'];


    $query = "DELETE FROM USERS WHERE Email='$email'";

    mysqli_query($con, $query);

    echo "account deleted";

    //echo("Error description: " . mysqli_error($con));
}

mysqli_close($con);

?>