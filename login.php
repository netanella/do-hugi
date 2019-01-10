<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>דו-חוגי | התחברות</title>
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" type="text/css" href="css/generic.css">

</head>

<body id="login" background="img/grass.jpg">
<header>
    <!-- minimal navigation bar for unlogged users -->
    <nav class="navbar">
        <a href="index.html" id="logo"><img src="img/LOGO.JPG"></a>
        <ul id="navLinks">
        </ul>
    </nav>
</header>

<!-- sign up forms for existing users -->
<div class="centered-form">
    <h1>התחברות</h1>
    <br>
    <form id="log-in" method="post" action="logIn.php">
        <label for="email"> דוא"ל: </label><br>
        <input id="email" class="textInput" type="text" name="email" required><br><br>
        <label for="password"> סיסמא: </label><br>
        <input id="password" class="textInput" type="password" name="pwd" required><br>
        <button class="loginbutt" type="submit" name="login">התחבר</button>
        <br>
        <!--check login information in database-->
        <?php include "connectDBclass.php";
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $password = $_POST['pwd'];

            $password = filter_var($password, FILTER_SANITIZE_STRING);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            //SELECT user that matches log in information
            $query = "SELECT * FROM users where Email='$email' and Password='$password'";
            $connectDB = new connectDBclass();
            $result = $connectDB->applyQuery($query);

            //if no match was found show message
            if (mysqli_num_rows($result) == 0) {
                echo "הפרטים שהוזנו שגויים. אנא נסה שנית";
            } else {
                //if match was found - start new session
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['firstname'] = $row['First_Name'];
                $_SESSION['lastname'] = $row['Last_Name'];
                $_SESSION['about'] = $row['About'];
                $_SESSION['hobbies'] = $row['Hobbies'];
                if ($row['profilePhoto'] == NULL) {
                    $_SESSION['PhotoPath'] = "img/img_avatar.png";
                } else $_SESSION['PhotoPath'] = "uploads/" . $row['profilePhoto'];
                header('Location:hugSearch.php');
            }
        }
        ?>
    </form>

    <div>
        <a href="restorePassword.html"> שכחתי סיסמא</a>
        <br><br>
        <span>עוד לא רשומים לאתר?</span>
        <a href="signUp.php"><strong>לחץ כאן להרשמה</strong> </a>
    </div>
    <br>
    <a href="index.html" id="back">חזרה</a>
</div>

</body>
</html>