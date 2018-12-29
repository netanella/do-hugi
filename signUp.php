<?php

if (isset($_POST['submit'])) {
    $con = mysqli_connect($_SERVER['localhost:63342'], 'root', '', 'dohugi');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    /*
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $bday=$_POST['bday'];
    $gender=$_POST['gender'];
    $about=$_POST['about'];
    $hobbies=$_POST['hobbies'];
    $image=$_POST['imageUpload'];*/

    $query = "INSERT INTO users (Email, First_Name, Last_Name, Password, Phone, DOB, Gender, About, Hobbies, Photo_url) 
              VALUES ('shaharlevi@gmail.com', 'לוי', 'שחר', 'quu123', '9724441200', '2000-12-12', 'M', 'JGJHG', 'FJGFJH', 'HJH')";
    mysqli_query($con, $query);
    mysqli_close($con);
}




/* MOTTI
if (isset($_POST['submit'])) {
    $con = mysqli_connect($_SERVER['localhost:63342'],'root', '', 'walkiz');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    $email=$_POST['email'];
    $pass=$_POST['password'];
    $check_query=mysqli_query($con,'SELECT* FROM customers where Email=$email and Password=$pass');
    if(mysqli_num_rows($check_query)>0){
        header('Location:index.html');
    }
    $check_query_walker = mysqli_query($con, 'SELECT* FROM dogwalker where Email= $email and Password=$pass');
    if (mysqli_num_rows($check_query_walker) > 0) {
        header('Location:walker-personal-profile.html');
    }
    else{
        //wrong();

    }
    mysqli_close($con);
}
*/

?>






?>