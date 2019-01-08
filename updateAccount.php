<?php include "connectDBclass.php";

if (isset($_POST['submit5'])) {

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $about=$_POST['about'];
    $hobbies=$_POST['hobbies'];

    $query = "UPDATE USERS SET First_Name='$firstname', Last_Name='$lastname', About='$about', Hobbies='$hobbies' 
                WHERE Email='$email'";

    $connectDB = new connectDBclass();
    $result = $connectDB -> applyQuery($query);

    echo "Details were updated successfully";

}


?>