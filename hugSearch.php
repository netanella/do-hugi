<?php include "connectDBclass.php";
if (isset($_POST['textsearch'])) {
    $input = $_POST['textInput'];
    $title = "תוצאות חיפוש: ".$input;
    //SELECT QUERY - text search workshops by tags
    $query = "SELECT * FROM workshops JOIN workshops_tags ON workshops.Workshop_ID = workshops_tags.Workshop_ID
              WHERE workshops_tags.tag LIKE '%$input%'
              ORDER BY Workshop_Date
              LIMIT 40";

    $connectDB = new connectDBclass();
    $result = $connectDB -> applyQuery($query);
}

else {
    $title = "כל החוגים";
    //SELECT QUERY - display all hugim in DB
    $query = "SELECT * FROM workshops ORDER BY Workshop_Date LIMIT 40";
    $connectDB = new connectDBclass();
    $result = $connectDB -> applyQuery($query);
}

?>
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <title> דו-חוגי | קטלוג </title>
    <link href="css/hugSearch.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="calendar/styles/calendar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta charset="UTF-8">
</head>
<body>
<header>
    <!-- navigation bar for all pages -->
    <?php include('navbar.php'); ?>
</header>
<main>
    <!-- navigation bar of categories-->
    <aside id="navbarAllHobbies">
        <!--calendar place-->
        <div id="calendar-w"> </div>
        <br>
        <nav>
            <a class="active" href="hugSearch.php"> כל החוגים</a>
            <a href=""> מוזיקה </a>
            <a href=""> אמנות </a>
            <a href=""> ספורט </a>
            <a href=""> בישול </a>
            <a href=""> אפייה </a>
            <a href=""> ריקוד </a>
            <a href=""> איפור </a>
            <a href=""> עיצוב שיער </a>
            <a href=""> מחשבים ואינטרנט </a>
            <a href=""> משחק ודרמה </a>
            <a href=""> בעלי חיים </a>
        </nav>
    </aside>
    <!-- running photos of the site options-->
    <div id="sliderphotos">
        <div class="hugSlide">
            <img id="alco" src="img/alco.jpg">
            <label for="alco">סדנת אלכוהול</label>
        </div>
        <div class="hugSlide">
            <img id="keramika" src="img/keramika.jpg">
            <label for="keramika">חוג קרמיקה</label>
        </div>
        <div class="hugSlide">
            <img id="zer" src="img/zer.jpg">
            <label for="zer">הכנת זרים לראש</label>
        </div>
        <div class="hugSlide">
            <img id="zmidim" src="img/zmidim.jpg">
            <label for="zmidim">הכנת צמידים</label>
        </div>
        <div class="hugSlide">
            <img id="pilates" src="img/pilates.jpg">
            <label for="pilates">פילאטיס</label>
        </div>
        <div class="hugSlide">
            <img id="teva" src="img/teva.jpg">
            <label for="teva">סדנאות בטבע</label>
        </div>
    </div>

    <?php
    echo '<h1>'.$title.'</h1>';
    echo '<form id="allHugim" method="get" action="hugDetails.php">';
    //fetch search results
    if (isset($result)){
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['Workshop_ID'];
            $name = $row['Workshop_Name'];
            $date = $row['Workshop_Date'];
            $imagePath = 'uploads/' . $row['Photo'];
            echo '<div>
                <h2 class="center-inpos">'.$name.'</h2>
                <img src="'.$imagePath.'">
                <p>תאריך: '.$date.'</p>
                <button type="submit" name="details" class="signupButton" value="'.$id.'">להרשמה</button>
            </div>';
        }
        //if the search has no results show message
        if (mysqli_num_rows($result) == 0){
            echo '<p>אופס! החיפוש המבוקש לא הניב תוצאות</p>';
        }
        echo '</div>';
    }
    ?>
</main>
<!-- connection to JS file of the calendar-->
<script src="js/calendar.js"></script>
<!-- connection to JS file of the slider photos-->
<script src="js/slider.js"></script>
<script>
    new Calendar('calendar-w'); /*create the calendar*/
</script>
</body>
</html>