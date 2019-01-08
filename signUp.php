<?php

if (isset($_POST['signup'])) {

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

    include "connectDBclass.php";

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $dob=$_POST['bday'];
    $gender=$_POST['gender'];
    $about=$_POST['about'];
    $hobbies=$_POST['hobbies'];

    //Sanitize values
    $firstname=filter_var($firstname, FILTER_SANITIZE_STRING);
    $lastname=filter_var($lastname, FILTER_SANITIZE_STRING);
    $password=filter_var($password, FILTER_SANITIZE_STRING);
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $phone=filter_var($phone, FILTER_SANITIZE_STRING);
    $about=filter_var($about, FILTER_SANITIZE_STRING);
    $hobbies=filter_var($hobbies, FILTER_SANITIZE_STRING);

    //Validate values
    $email=filter_var($email, FILTER_VALIDATE_EMAIL);

    $query = "INSERT INTO users (Email, First_Name, Last_Name, Password, Phone, DOB, Gender, About, Hobbies, Photo)
              VALUES ('$email', '$firstname', '$lastname', '$password', '$phone', '$dob', '$gender', '$about', '$hobbies', '$image')";

    $connectDB = new connectDBclass();
    $connectDB -> applyQuery($query);

    header("Location:index.html");

}

?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>דו-חוגי | הרשמה</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body id="signupPage" background="img/grass.jpg">
<header>
    <!-- navigation bar - not signed in -->
    <nav class="navbar">
        <a href="index.html" id="logo"><img src="img/LOGO.JPG"></a>
        <ul id="navLinks">
            <li><a href="aboutus.php">קצת עלינו</a></li>
            <li><a href="contact.php">צור קשר</a></li>
        </ul>
    </nav>
</header>
<main class="centered-form">
    <!-- sign up form for new users -->
    <h1>הצטרפו אלינו</h1>
    <p id="first">כדאי לכם. כיף פה!</p>
    <form id="registration" method="post" action="signUp.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td> <label for="name">שם פרטי: </label></td>
                <td> <input id="name" class="textInput" type="text" name="firstname" required></td>
            </tr>
            <tr>
                <td><label for="lastname">  שם משפחה:  </label> </td>
                <td><input id="lastname" class="textInput" type="text" name="lastname" required></td>
            </tr>
            <tr>
                <td> <label for="password">  סיסמא:   </label></td>
                <td> <input id="password" class="textInput" type="password" name="password" required></td>
            </tr>

            <tr>
                <td><label for="passwordcon">  אשר את הסיסמא:   </label></td>
                <td><input id="passwordcon" class="textInput" type="password"  name="password-conf" required></td>
            </tr>
            <tr>
                <td> <label for="email"> E-mail:  </label></td>
                <td> <input id="email" class="textInput" type="email" name="email" required></td>
            </tr>
            <tr>
                <td>  <label for="phone"> מספר טלפון:  </label></td>
                <td>  <input id="phone" class="textInput" type="text" name="phone" required></td>
            </tr>
            <tr>
                <td><label for="bday"> תאריך לידה: </label></td>
                <td><input id="bday" class="textInput" type="date" name="bday" required></td>
            </tr>

            <tr>
                <td><label for="gender"> מין: </label></td>
                <td id="gender">
                    <label for="male">
                        <input type="radio" id="male" name="gender" value="male" checked>
                        <span>זכר</span>
                    </label>
                    <label for="female">
                        <input type="radio" name="gender" id="female" value="female">
                        <span>נקבה</span>
                    </label>
                    <label for="other">
                        <input id="other" type="radio" name="gender" value="other">
                        <span>אחר</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td> <label for="about"> ספר לנו קצת על עצמך </label></td>
                <td> <textarea id="about" rows="7" cols="35" name="about"></textarea></td>
            </tr>
            <tr>
                <td> <label for="hobbies"> תחביבים ותחומי עניין </label></td>
                <td> <textarea id="hobbies" rows="7" cols="35" name="hobbies"></textarea></td>
            </tr>
            <tr>
                <!-- option to upload image to website -->

                <td> <label for="profile-photo"> העלאת תמונת פרופיל </label></td>
                <td>
                    <div id="profile-photo" class="uploadFile">
                        <label for="imageUpload"><i class="material-icons">cloud_upload</i>
                            <span>בחר תמונה</span></label>
                        <input id="imageUpload" type="file" name="profile_pic" accept="image/*">
                    </div>
                </td>
            </tr>
        </table>
        <button class="form-submit-btn" type="submit" name="signup">סיום והרשמה<span></span> </button>
        <a href="index.html" id="back">חזרה</a>
    </form>
</main>
</body>
</html>