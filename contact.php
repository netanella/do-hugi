<?php include "connectDBclass.php";
if(isset($_POST['contactus'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    //Sanitize values
    $name=filter_var($name, FILTER_SANITIZE_STRING);
    $email=filter_var($email, FILTER_SANITIZE_EMAIL);
    $message=filter_var($message, FILTER_SANITIZE_STRING);
    //Validate values
    $email=filter_var($email, FILTER_VALIDATE_EMAIL);

    //INSERT QUERY - add user message to database
    $query = "INSERT INTO messages(Username, Email, Message) VALUES ('$name','$email','$message');";
    $connectDB = new connectDBclass();
    $result = $connectDB -> applyQuery($query);
}
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>דו-חוגי | צור קשר</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body id="contactUsPage" background="img/grass.jpg">
<header>
    <!-- navigation bar for all pages -->
    <?php include('navbar.php'); ?>
</header>
<main class = "centered-form">
    <h1>צרו איתנו קשר</h1>
    <br>
    <form id="contactus" action="" method="post">
        <div id="writeToUs" class="contactUs">
            <h3><img id="email" src="img/mail.png" width="30" height="30"> כתבו לנו </h3>
            <label for="username">  שם מלא: </label>
            <br>
            <input id="username" class="textInput" type="text" name="username" required/>
            <br>
            <label for="e-mail">  אימייל:  </label>
            <br>
            <input id="e-mail" class="textInput" type="text" name="email" required/>
            <br>
            <label for="message"> פרטי ההודעה: </label>
            <br>
            <textarea id="message" rows="6" cols="35" name="message" required></textarea>
            <button type="submit" name="contactus" class="form-submit-btn" onclick="alert('הודעת התקבלה. תודה שפנית אלינו, נשוב אליך בהקדם! צוות האתר.');">
                שלח
                <span></span></button>
        </div>
        <div id="callUs" class="contactUs">
            <h3> <img  id="phone" src="img/phone.png" width="30" height="30">התקשרו אלינו</h3>
            <p>054-2122349 - לי אוחיון, מנכ"לית</p>
            <p>053-4228085 - נתנאלה ברנד, CTO</p>
            <p>054-3387235 - שחר בר מאיר, מנהלת קשרי חוץ</p>
        </div>
    </form>
</main>
</body>
</html>