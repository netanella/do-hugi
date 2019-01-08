<?php
echo
'<nav class="navbar">
        <a href="hugSearch.php" id="logo"><img src="img/LOGO.JPG"></a>
        <ul id="navLinks">
            <li><a href="hugSearch.php">קטלוג חוגים</a></li>
            <li><a href="submitNewHug.php">יצירת חוג</a></li>
            <li><a href="aboutus.php">קצת עלינו</a></li>
            <li><a href="contact.php">צור קשר</a></li>
            <li>
                <form id="searchBar" method="post" action="hugSearch.php">
                    <input type="text" placeholder="חפש חוג" name="textInput">
                    <button type="submit" name="textsearch"><i class="material-icons">search</i></button>
                </form>
            </li>
        </ul>
        <!-- user profile menu options-->
        <div id="userProfile" class="dropdown">';
            session_start();
            if(isset($_SESSION["firstname"])) {
                    echo '<a href="userProfile.php"><span>'.$_SESSION['firstname'].'</span>';
                    echo '<img class="profilePhotoIcon" src="'.$_SESSION['PhotoPath'].'"></a>';
            }
            echo '
            <div class="dropdown-content">
                <a href="userProfile.php">הפרופיל שלי</a>
                <a href="userProfile.php">החוגים שלי</a>
                <a href="logout.php">התנתקות</a>
            </div>
        </div>
    </nav>'
?>