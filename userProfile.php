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
            <?php include "connectDBclass.php";
            //get information from current session
            $photoPath = $_SESSION['PhotoPath'];
            $first_name = $_SESSION['firstname'];
            $last_name= $_SESSION['lastname'];
            $email=$_SESSION['email'];
            $about=$_SESSION['about'];
            $hobbies=$_SESSION['hobbies'];
            //if not my profile
            if(isset($_GET['userprofile']) && $_GET['userprofile']!=$_SESSION['email']) {
                //get user data
                $userEmail = $_GET['userprofile'];
                $query = "SELECT * FROM users WHERE Email='$userEmail'";
                $connectDB = new connectDBclass();
                $result = $connectDB -> applyQuery($query);
                $row = mysqli_fetch_assoc($result);
                $photoPath = 'uploads/'.$row['profilePhoto'];
                $first_name = $row['First_Name'];
                $last_name= $row['Last_Name'];
                $email=$row['Email'];
                $about=$row['About'];
                $hobbies=$row['Hobbies'];
            }

            echo '<img class="profilePhotoIcon" src="'.$photoPath.'">
                    <h2>'.$first_name.' '.$last_name.'</h2>';
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
            <?php
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
            <textarea id="interests" rows="4" name="hobbies">'.$hobbies.'</textarea>';
            ?>
            <div class="align-left-cont" id="update-btn">
                <?php
                //show update button only when i am viewing my own profile
                if($email==$_SESSION['email']){
                    echo '
                <button type="submit" name="updateDetails">עדכון פרטים</button>';
                }
                else echo '<br><br>';

                //update user details in DB
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

                    //refresh page
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
            //SELECT QUERY - upcoming hugim that the user registered to
            $query = "SELECT registrations.Workshop_ID, Workshop_Name, Workshop_Date, Photo 
                              FROM registrations JOIN workshops ON registrations.Workshop_ID = workshops.Workshop_ID 
                              WHERE registrations.Email = '$email' AND Workshop_Date>=CURRENT_DATE()";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);
            if (mysqli_num_rows($result)>0){
                echo '<h4>חוגים אליהם נרשמתי - שריינו יומנים! <span id="showAllUpcoming"></span></h4>
                       <ul id="upcoming-list">';
                while($row=mysqli_fetch_assoc($result)){
                    $hugID=$row['Workshop_ID'];
                    $hugName=$row['Workshop_Name'];
                    $hugDate=$row['Workshop_Date'];
                    $hugImgPath='uploads/'.$row['Photo'];
                    echo '<li class="hugContainer">
                                 <button type="submit" name="details" value="'.$hugID.'">
                                      <img class="hugImage" src="'.$hugImgPath.'">
                                      <span><strong>'.$hugDate.'</strong> <br>'.$hugName.'</span>
                                 </button>
                           </li>
                        ';
                }
                echo '</ul>';
            }

            //LIST OF HUGIM I OFFER

            //SELECT QUERY - hugim that the user created
            $query = "SELECT Workshop_ID, Workshop_Name, Workshop_Date, Photo FROM workshops
                              WHERE userCreated = '$email'";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);

            if (mysqli_num_rows($result)>0) {
                echo '<h4>חוגים שאני מעביר<span id="showAllCreated"></span></h4>
                         <ul id="created-list">';
                while ($row = mysqli_fetch_assoc($result)) {
                    $hugID = $row['Workshop_ID'];
                    $hugName = $row['Workshop_Name'];
                    $hugDate = $row['Workshop_Date'];
                    $hugImgPath = 'uploads/' . $row['Photo'];
                    echo '<li class="hugContainer">
                          <button type="submit" name="details" value="' . $hugID . '">
                                <img class="hugImage" src="' . $hugImgPath . '">
                                <span><strong>' . $hugDate . '</strong> <br>' . $hugName . '</span>
                          </button>
                       </li>';
                }
                echo '</ul>';
            }


            //LIST OF PAST HUGIM

            //SELECT QUERY - past hugim that the user attended
            $query = "SELECT registrations.Workshop_ID, Workshop_Name, Workshop_Date, Photo 
                              FROM registrations JOIN workshops ON registrations.Workshop_ID = workshops.Workshop_ID 
                              WHERE registrations.Email = '$email' AND Workshop_Date<CURRENT_DATE()";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);
            if (mysqli_num_rows($result)>0){
                echo '<h4>חוגים בהם השתתפתי <span id="showAllAttended"></span></h4>
                <ul id="attended-list">';
                while($row=mysqli_fetch_assoc($result)){
                    $hugID=$row['Workshop_ID'];
                    $hugName=$row['Workshop_Name'];
                    $hugDate=$row['Workshop_Date'];
                    $hugImgPath='uploads/'.$row['Photo'];
                    echo '<li class="hugContainer disabled">
                                <button type="submit" name="details" value="'.$hugID.'">
                                      <img class="hugImage" src="'.$hugImgPath.'">
                                      <span><strong>'.$hugDate.'</strong> <br>'.$hugName.'</span>
                                 </button>
                          </li>';
                }
                echo '</ul>';
            }
            ?>
        </form>
    </section>
</main>
<script src="js/expandingElements.js"></script>
<script src="js/sideNavStyleOnPageScroll.js"></script>
</body>
</html>