<!--get information about the hug chosen by the user-->
<?php include "connectDBclass.php";

if(isset($_GET['details'])){
    $hugID = $_GET['details'];
    //SELECT QUERY - hug data from DB
    $query = "SELECT * FROM workshops WHERE Workshop_ID='$hugID'";
    $connectDB = new connectDBclass();
    $result = $connectDB -> applyQuery($query);
    $row = mysqli_fetch_assoc($result);
    $hugName = $row['Workshop_Name'];
    $location = $row['Location'];
    $date = $row['Workshop_Date'];
    $hour = $row['Start_Time'];
    $duration = $row['Duration'];
    $maxParticipants = $row['Max_participants'];
    $price = $row['Price'];
    $about = $row['About'];
    $photoPath = 'uploads/'.$row['Photo'];
}

?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>דו חוגי | פרטי חוג</title>
    <link rel="stylesheet" type="text/css" href="css/hugDetails.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<!--custom dialog box-->
<div id="dialogoverlay"></div>
<div id="dialogbox">
    <div id="dialogboxhead"></div>
    <div id="dialogboxbody"></div>
    <div id="dialogboxfoot"></div>
</div>
<header>
    <!-- navigation bar for all pages -->
    <?php include 'navbar.php'; ?>
</header>
<main>
    <!-- hug preview image and title -->
    <div id="topStrip">
        <img class="mainPhoto" src="<?php echo $photoPath ?>">
        <div class="heading">
            <h1><?php echo $hugName ?> / </h1>
            <h3> נוצר על ידי: &nbsp;
                <a href="userProfile.php"> <img src="img/img_avatar.png"> </a>
                <a href="userProfile.php"> איתי הראל </a>
            </h3>
        </div>
    </div>


    <!-- information about the hug - location, price etc -->
    <section id="hugDetails">
        <!-- Google map -->
        <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3410.5494261259055!2d34.78931890075295!3d31.26089428136519!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x58cda349c891b450!2sBar+Giora!5e0!3m2!1sen!2sil!4v1543957417185" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

        <ul id="date-time-place">
            <li><i class="material-icons">location_on</i>
                מיקום:
                <?php echo $location ?>
            </li>
            <li><i class="material-icons">event</i>
                תאריך:
                <?php echo $date ?>
            </li>
            <li><i class="material-icons">access_time</i>
                שעה:
                <?php echo $hour ?>
            </li>
        </ul>

        <div id="description">
            <p><?php echo $about ?></p>
            <p><strong>מספר משתתפים מקסימלי: </strong><?php echo $maxParticipants ?></p>
            <p><strong>מחיר: </strong>
                <?php
                if($price == 0){
                    echo 'חינם!';}
                else echo $price.' ש"ח';
                ?>
            </p>
            <br>
            <!--signup and cancel buttons-->
            <?php
            $email = $_SESSION['email'];
            $date = date('Y-m-d');
            if(isset($_POST['signup-status'])){
                if($_POST['signup-status']=='signme'){
                    //INSERT QUERY - register a user to the hug
                    $query = "INSERT INTO registrations (`Workshop_ID`, `Email`, `Date`) VALUES ('$hugID', '$email', '$date');";
                    $connectDB = new connectDBclass();
                    $result = $connectDB -> applyQuery($query);
                }
                if($_POST['signup-status']=='removeme'){
                    //DELETE QUERY - delete user registration to hug
                    $query = "DELETE FROM registrations WHERE Workshop_ID='$hugID' AND Email='$email'";
                    $connectDB = new connectDBclass();
                    $result = $connectDB -> applyQuery($query);
                }
            }?>

            <form name="signupHug" action="" method="post">
                <div class="switch-txt-btn">
                    <input type="radio" id="signup" name="signup-status" value="signme"
                        <?php
                        //SELECT QUERY - check if the user is registered to the hug (in order to set signup/cancel button design)
                        $query = "SELECT * FROM registrations WHERE Workshop_ID='$hugID' AND Email='$email'";
                        $connectDB= new connectDBclass();
                        $result = $connectDB -> applyQuery($query);
                        if (mysqli_num_rows($result)>0){
                            echo 'checked';
                        }
                        ?>
                           onchange="confirm.pop('אתה עומד להרשם לחוג. האם תרצה להמשיך?','signup');">
                    <label for="signup" class="like-btn">
                        <span class="before">רשום אותי!</span>
                        <span class="after"><span>&#10004;</span>אני מגיע</span>
                    </label>
                </div>
                <div class="switch-txt-btn">
                    <input type="radio" id="cancel" name="signup-status" value="removeme"
                        <?php
                        //If the user is not signed up to hug according to DB - check the 'not registered' button
                        if (mysqli_num_rows($result)==0){
                            echo 'checked';
                        }
                        ?>
                           onchange="confirm.pop('אתה עומד לבטל את הרשמתך. האם תרצה להמשיך?','cancel');">
                    <label for="cancel" class="like-btn">
                        <span class="before">ביטול הרשמה</span>
                        <span class="after"><span>&#10006;</span>לא רשום</span>
                    </label>
                </div>
            </form>
            <hr>
        </div>
    </section>

    <!-- list of users who are attending this hug -->
    <section id="attending"><br>
        <h3>מי מגיע?</h3><br>
        <?php
            //SELECT QUERY -  get data about users who signed up to the hug
            $query = "SELECT First_Name, Last_Name, Photo FROM users JOIN registrations ON users.Email = registrations.Email 
                              WHERE Workshop_ID='$hugID'";
            $connectDB = new connectDBclass();
            $result = $connectDB -> applyQuery($query);
            //if no users registered
            if (mysqli_num_rows($result)==0){
                echo '<br>אף אחד עוד לא נרשם לחוג. אולי תהיה ראשון?';
            }
            echo '<div class="scroll-section">';
            //show arrows only when needed (more than 5 users registered)
            if (mysqli_num_rows($result)>5){
                echo '<button class="material-icons"><span onclick="scrollBar(\'userList\',\'right\',142)" id="right-nav-arrow">arrow_right</span></button>';
            }
            ?>
            <div class="scroll-wrap">
                <ul id="userList" class="scroll-list">
                    <?php
                    //display list of users registered to the hug
                    while($row = mysqli_fetch_assoc($result)) {
                        $firstname = $row['First_Name'];
                        $lastname = $row['Last_Name'];
                        if ($row['Photo']==NULL){
                            $imagePath = 'img/img_avatar.png';
                        }
                        else $imagePath = 'uploads/' . $row['Photo'];
                        echo '<li class="scroll-item">
                                <a  href="">
                                    <img src="'.$imagePath.'"/>
                                    <p>'.$firstname.' '.$lastname.'</p>
                                </a>
                              </li>';
                    }
                    ?>
                </ul>
            </div>
            <!-- left arrow -->
            <?php //show arrows only when needed (over 5 users registered)
            if (mysqli_num_rows($result)>5){
                echo '<button class="material-icons"><span onclick="scrollBar(\'userList\',\'left\',142)" id="left-nav-arrow">arrow_left</span></button>';
            }
            ?>
    </section>
</main>
<script src="js/scrollBar.js"></script>
<script src="js/confirmPopup.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCG_CFNEjAlR0uOWWvExGf9EoPW5upL7Fc&callback=myMap"></script>
</body>
</html>
