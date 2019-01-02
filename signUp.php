<?php

if (isset($_POST['submit'])) {

    var_dump($_FILES);

    // Select your own upload directory on the server
    $uploadsFolder = "uploads/" ;

    // Create directory if not exists
    if (!is_dir($uploadsFolder)) {
        mkdir($uploadsFolder);
    }

    // Move the file from the temp directory to the new directory
    foreach($_FILES as $key => $file) {
        move_uploaded_file($_FILES[$key]["tmp_name"], $uploadsFolder . $_FILES[$key]["name"]);
        $image=$_FILES[$key]["name"];
    }

    $con = mysqli_connect('localhost', 'root', '', 'dohugi');
    mysqli_set_charset($con,'utf8');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $dob=$_POST['bday'];
    $gender=$_POST['gender'];
    $about=$_POST['about'];
    $hobbies=$_POST['hobbies'];

    $query = "INSERT INTO users (Email, First_Name, Last_Name, Password, Phone, DOB, Gender, About, Hobbies, Photo)
              VALUES ('$email', '$firstname', '$lastname', '$password', '$phone', '$dob', '$gender', '$about', '$hobbies', '$image')";

    mysqli_query($con, $query);

    header("Location:http://localhost:8080/do-hugi/index.html");
}

mysqli_close($con);

?>