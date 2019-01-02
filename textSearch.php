<?php

if (isset($_POST['submit4'])) {
    $con = mysqli_connect('localhost', 'root', '', 'dohugi');
    mysqli_set_charset($con,'utf8');

    if (!$con) {
        die("Connection error: " . mysqli_connect_errno());
    }

    $input = $_POST['textInput'];


    $query = "SELECT * FROM workshops JOIN workshops_tags ON workshops.Workshop_ID = workshops_tags.Workshop_ID
              WHERE workshops_tags.tag = '$input' 
              ORDER BY Workshop_Date DESC
              LIMIT 20";

    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_row($result)){
        echo $row[1];
    }


    //echo("Error description: " . mysqli_error($con));
}

mysqli_close($con);

?>