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
    <nav class="navbar">
        <a href="hugSearch.php" id="logo"><img src="img/LOGO.JPG"></a>
        <ul id="navLinks">
            <li><a href="hugSearch.php">קטלוג חוגים</a></li>
            <li><a href="submitNewHug.php">יצירת חוג</a></li>
            <li><a href="aboutus.html">קצת עלינו</a></li>
            <li><a href="contact.html">צור קשר</a></li>
            <li>
                <form id="searchBar" action="textSearch.php">
                    <input type="text" placeholder="חפש חוג" name="search">
                    <button type="submit"><i class="material-icons">search</i></button>
                </form>
            </li>
        </ul>
    </nav>
</header>
<main>
    <!-- side bar with user photo and navigation menu -->
    <aside>
        <div id="userOverview">
            <img class="profilePhotoIcon" src="img/barak.JPG">
            <h2>ברק פינצובסקי</h2>
            <a class="like-btn" id="logout" href="index.html">התנתקות</a>
        </div>
        <hr>
        <nav id="sideNav">
            <a id="section1" href="#userProfilePage">הפרטים שלי</a>
            <a id="section2" href="#update-btn">החוגים שלי</a>
        </nav>
    </aside>
    <!-- user current details with option for the user update information -->
    <section id="userDetails">
        <form method="post" action="updateAccount.php">
            <h1>הפרטים שלי</h1>
            <?php
                session_start();
                $email=$_SESSION['email'];
                $first_name= $_SESSION['firstname'];
                $last_name= $_SESSION['lastname'];
                $about=$_SESSION['about'];
                $hobbies=$_SESSION['hobbies'];
            ?>

            <div id="first-name-con">
                <label for="firstName">שם פרטי</label>
                <input id="firstName" type="text" value="ברק" name="firstname">
            </div>
            <div id="last-name-con">
                <label for="lastName">שם משפחה</label>
                <input id="lastName" type="text" value="פינצ'ובסקי" name="lastname">
            </div>
            <label for="email">דוא"ל</label>
            <input id="email" type="text" value="brkpinch@post.bgu.ac.il" name="email" readonly>
            <label for="about">על עצמי</label>
            <textarea id="about" rows="4" name="about">אני מפתח בחברת הייטק מגניבה</textarea>
            <label for="interests">תחומי עניין</label>
            <textarea id="interests" rows="4" name="hobbies">אני אוהב תכנות ווב ופינג פונג</textarea>
            <div class="align-left-cont" id="update-btn">
                <button type="submit" name="submit5">עדכון פרטים</button>
                <button type="submit" name="submit6" onclick="confirm('אתה עומד להמחק מהמערכת. האם אתה בטוח? פעולה זו אינה ניתנת לביטול')">מחק אותי</button>
            </div>
        </form>
        <hr><br>
        <!-- list of all user's hugim (hugim that past are disabled) -->
        <div id="myHugim">
            <h1>החוגים שלי</h1>
            <h4>בקרוב - שריינו יומנים!</h4>
            <ul>
                <li>
                    <a href="hugDetails.php"><img class="hugImage" src="img/sculpture.jpg">
                        <span><strong>3.12.18</strong> <br> פיסול בחימר ואלגברה לינארית עם נדיה </span></a>
                </li>
                <li>
                    <a href="hugDetails.php"><img class="hugImage" src="img/quidditch.jpg">
                        <span><strong>8.12.18</strong> <br> קווידיץ' למתחילים </span></a>
                </li>
            </ul>
            <h4>חוגים שאני מעביר</h4>
            <ul>
                <li>
                    <a href="hugDetails.php"><img class="hugImage" src="img/mobile-apps.jpg">
                        <span><strong>18.01.19</strong> <br> פיתוח אפליקציות למובייל </span></a>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/javascript.jpeg">
                    <span><strong>2.06.18</strong> <br> Javascript למתחילים </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/CSS.jpg">
                    <span><strong>11.03.18</strong> <br> CSS היא לא (בהכרח) מילה גסה </span>
                </li>
            </ul>
            <h4>חוגים בהם השתתפתי <span id="showAllAttended"></span></h4>
            <ul id="attended-list">
                <li class="disabled">
                    <img class="hugImage" src="img/catfeeding.jpg">
                    <span><strong>17.11.18</strong> <br> קורס האכלת חתולים בשער סורוקה </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/beerpong.jpg">
                    <span><strong>6.11.18</strong> <br> טורניר ביר פונג בבית הסטודנט </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/meditation.jpg">
                    <span><strong>2.11.18</strong> <br> מדיטציה בספריית ארן </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/treasure.jpg">
                    <span><strong>22.9.18</strong> <br> "חפש את המטמון" בבניין 72 </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/catfeeding.jpg">
                    <span><strong>17.11.18</strong> <br> קורס האכלת חתולים בשער סורוקה </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/beerpong.jpg">
                    <span><strong>6.11.18</strong> <br> טורניר ביר פונג בבית הסטודנט </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/meditation.jpg">
                    <span><strong>2.11.18</strong> <br> מדיטציה בספריית ארן </span>
                </li>
                <li class="disabled">
                    <img class="hugImage" src="img/treasure.jpg">
                    <span><strong>22.9.18</strong> <br> "חפש את המטמון" בבניין 72 </span>
                </li>
            </ul>
        </div>
    </section>
</main>
<script src="js/scrollBar.js"></script>
<script src="js/expandingElements.js"></script>
<script src="js/sideNavStyleOnPageScroll.js"></script>
</body>
</html>