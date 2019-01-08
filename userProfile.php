<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>דו-חוגי | הפרופיל שלי</title>
    <link rel="stylesheet" type="text/css" href="css/userProfile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body id="userProfilePage">
<header>
    <!-- navigation bar for all pages -->
    <?php include('navbar.php'); ?>
</header>
<main>
    <!-- side bar with user photo and navigation menu -->
    <aside>
        <div id="userOverview">
            <?php
            $photoPath = $_SESSION['PhotoPath'];
            $first_name = $_SESSION['firstname'];
            $last_name= $_SESSION['lastname'];
            echo '
                <img class="profilePhotoIcon" src="'.$photoPath.'">
                <h2>'.$first_name.' '.$last_name.'</h2>'
            ?>
            <a class="like-btn" id="logout" href="logout.php">התנתקות</a>
        </div>
        <hr>
        <nav id="sideNav">
            <a id="section1" href="#userProfilePage">הפרטים שלי</a>
            <a id="section2" href="#update-btn">החוגים שלי</a>
        </nav>
    </aside>
    <!-- user current details with option for the user update information -->
    <section id="userDetails">
        <form method="post" action="userProfile.php">
            <h1>הפרטים שלי</h1>
            <?php include "connectDBclass.php";
            $email=$_SESSION['email'];
            $first_name= $_SESSION['firstname'];
            $last_name= $_SESSION['lastname'];
            $about=$_SESSION['about'];
            $hobbies=$_SESSION['hobbies'];
            echo '
                <div id="first-name-con">
                    <label for="firstName">שם פרטי</label>
                    <input id="firstName" type="text" value="'.$first_name.'" name="firstname">
                </div>
                <div id="last-name-con">
                <label for="lastName">שם משפחה</label>
                <input id="lastName" type="text" value="'.$last_name.'" name="lastname">
            </div>
            <label for="email">דוא"ל</label>
            <input id="email" type="text" value="'.$email.'" name="email" readonly>
            <label for="about">על עצמי</label>
            <textarea id="about" rows="4" name="about">'.$about.'</textarea>
            <label for="interests">תחומי עניין</label>
            <textarea id="interests" rows="4" name="hobbies">'.$hobbies.'</textarea>
            <div class="align-left-cont" id="update-btn">
                <button type="submit" name="updateDetails">עדכון פרטים</button>';

            if (isset($_POST['updateDetails'])) {
                $firstname=$_POST['firstname'];
                $lastname=$_POST['lastname'];
                $email=$_POST['email'];
                $about=$_POST['about'];
                $hobbies=$_POST['hobbies'];

                //Sanitize values
                $firstname=filter_var($firstname, FILTER_SANITIZE_STRING);
                $lastname=filter_var($lastname, FILTER_SANITIZE_STRING);
                $email=filter_var($email, FILTER_SANITIZE_EMAIL);
                $about=filter_var($about, FILTER_SANITIZE_STRING);
                $hobbies=filter_var($hobbies, FILTER_SANITIZE_STRING);

                //Validate values
                $email=filter_var($email, FILTER_VALIDATE_EMAIL);

                $query = "UPDATE USERS SET First_Name='$firstname', Last_Name='$lastname', About='$about', Hobbies='$hobbies' 
                WHERE Email='$email'";

                $connectDB = new connectDBclass();
                $result = $connectDB -> applyQuery($query);

                //update current session
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $last_name;
                $_SESSION['about'] = $about;
                $_SESSION['hobbies'] =$hobbies;

                header("Location:userProfile.php");
            }

            echo '</div>';
            ?>
        </form>
        <hr><br>
        <!-- list of all user's hugim (hugim that past are disabled) -->
        <form id="myHugim" action="hugDetails.php" method="get">
            <h1>החוגים שלי</h1>
            <!--LIST OF UPCOMING HUGIM-->
            <?php
            $query = "SELECT registrations.Workshop_ID, Workshop_Name, Workshop_Date, Photo 
                              FROM registrations JOIN workshops ON registrations.Workshop_ID = workshops.Workshop_ID 
                              WHERE registrations.Email = '$email' AND Workshop_Date>=CURRENT_DATE()";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);
            if (mysqli_num_rows($result)>0){
                echo '<h4>חוגים אליהם נרשמתי - שריינו יומנים!</h4>
                       <ul>';
                while($row=mysqli_fetch_assoc($result)){
                    $hugID=$row['Workshop_ID'];
                    $hugName=$row['Workshop_Name'];
                    $hugDate=$row['Workshop_Date'];
                    $hugImgPath='uploads/'.$row['Photo'];
                    echo '
                            <li class="hugContainer">
                                 <button type="submit" name="details" value="'.$hugID.'">
                                      <img class="hugImage" src="'.$hugImgPath.'">
                                      <span><strong>'.$hugDate.'</strong> <br>'.$hugName.'</span>
                                 </button>
                            </li>
                        ';
                }
                echo '</ul>';
            }
            ?>
            <!--LIST OF HUGIM I OFFER-->
            <h4>חוגים שאני מעביר</h4>
            <ul>
                <li class="hugContainer">
                    <a href=""><img class="hugImage" src="img/mobile-apps.jpg">
                        <span><strong>18.01.19</strong> <br> פיתוח אפליקציות למובייל </span></a>
                </li>
                <li class="disabled hugContainer">
                    <img class="hugImage" src="img/javascript.jpeg">
                    <span><strong>2.06.18</strong> <br> Javascript למתחילים </span>
                </li>
                <li class="disabled hugContainer">
                    <img class="hugImage" src="img/CSS.jpg">
                    <span><strong>11.03.18</strong> <br> CSS היא לא (בהכרח) מילה גסה </span>
                </li>
            </ul>

            <!--LIST OF PAST HUGIM-->
            <?php
            $query = "SELECT registrations.Workshop_ID, Workshop_Name, Workshop_Date, Photo 
                              FROM registrations JOIN workshops ON registrations.Workshop_ID = workshops.Workshop_ID 
                              WHERE registrations.Email = '$email' AND Workshop_Date<CURRENT_DATE()";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);
            if (mysqli_num_rows($result)>0){
                echo '<h4>חוגים בהם השתתפתי <span id="showAllAttended"></span></h4>
                <ul id="attended-list">';
                while($row=mysqli_fetch_assoc($result)){
                    $hugName=$row['Workshop_Name'];
                    $hugDate=$row['Workshop_Date'];
                    $hugImgPath='uploads/'.$row['Photo'];
                    echo '<li class="disabled">
                                <a href=""><img class="hugImage" src="'.$hugImgPath.'">
                                <span><strong>'.$hugDate.'</strong> <br>'.$hugName.'</span></a>
                          </li>';
                }
                echo '</ul>';
            }
            ?>
        </form>
    </section>
</main>
<script src="js/scrollBar.js"></script>
<script src="js/expandingElements.js"></script>
<script src="js/sideNavStyleOnPageScroll.js"></script>
</body>
</html>