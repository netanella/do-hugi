<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>יצירת חוג חדש</title>
    <link rel="stylesheet" type="text/css" href="css/submitNewHug.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<header>
    <!-- navigation bar for all pages -->
    <?php include('navbar.php'); ?>
</header>
<!-- submit form to add new hugim to the site -->
<main id="submitPage">
    <div id="newHugForm">
        <div>
            <h1>יצירת חוג חדש</h1>
            <h2>מלא את הפרטים הבאים ואנחנו נדאג לכל השאר.</h2>
        </div>
        <form method="post" action="form.php">
            <!-- section 1 - add information -->
            <section class="tab">
                <h3 class="sectionHeading">קצת פרטים טכניים</h3>
                <div id="questions">
                    <table>
                        <tr>
                            <td>
                                <label for="title">שם החוג</label><br>
                                <span class="symbol"><i class="material-icons">timeline</i></span>
                                <input id="title" type="text" name="title" maxlength="50" required><br>
                            </td>
                            <td>
                                <label for="place">איפה מתקיים?</label><br>
                                <span class="symbol"><i class="material-icons">location_on</i></span>
                                <input id="place" type="text" name="place" placeholder="הכנס כתובת מלאה" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="DTstart">מתי מתחילים?</label><br>
                                <span class="symbol"><i class="material-icons">event</i></span>
                                <input id="DTstart" type="datetime-local" name="dateTime" required><br>
                            </td>
                            <td>
                                <label for="DTend">מתי מסיימים?</label><br>
                                <span class="symbol"><i class="material-icons">access_time</i></span>
                                <input id="DTend" type="datetime-local" name="dateTime"><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <fieldset>
                                    <label for="maxPpl">מקסימום משתתפים?</label><br>
                                    <span class="symbol"><i class="material-icons">person</i></span>
                                    <input id="maxPpl" type="number" name="maxPpl" min="1">
                                    <input id="unlimited" type="checkbox" name="unlimited">
                                    <label for="unlimited"> ללא הגבלה</label>
                                </fieldset>
                            </td>
                            <td>
                                <fieldset>
                                    <label for="price">מחיר לאדם (בש"ח):</label><br>
                                    <span class="symbol"><i class="material-icons">attach_money</i></span>
                                    <input id="price" type="number" name="price">
                                    <input id="free" type="checkbox" name="free">
                                    <label for="free">חינם</label>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                    <div>
                        <label for="details">ספרו לנו עוד!</label><br>
                        <textarea id="details" name="details" rows="10" cols="90" placeholder="בלי להתקמצן במילים..."></textarea>
                    </div>
                </div>
            </section>
            <!-- section 2 - upload photo -->
            <section class="tab">
                <h3 class="sectionHeading">העלאת תמונה</h3>
                <div id="photoUpload">
                    <p>מומלץ מאוד להעלות תמונה שקשורה לחוג.</p>
                    <p>לתוצאות מיטביות בחר תמונה רוחבית באיכות גבוהה</p><br>
                    <div class="uploadFile">
                        <label for="image"><i class="material-icons">cloud_upload</i><span>בחר תמונה</span></label>
                        <input id="image" type="file" name="image">
                    </div>
                </div>
            </section>
            <!-- section 3 - choose tags -->
            <section class="tab">
                <h3 class="sectionHeading">בחירת תגיות</h3>
                <p>מה הנושא של החוג?</p>
                <p>בחר את התגיות המתאימות ביותר לחוג שלך</p>
                <input list="tagSearch" name="tag" placeholder="חפש תגית">
                <datalist id="tagSearch">
                    <option value="עוד ממאגר הנתונים"></option>
                    <option value="ועוד"></option>
                    <option value="ועוד"></option>
                </datalist>
                <br><br>
                <fieldset id="tagList">
                    <input type="checkbox" id="tag1" name="tag1" value="ספורט">
                    <label for="tag1">ספורט</label>
                    <input type="checkbox" id="tag2" name="tag2" value="מוזיקה">
                    <label for="tag2">מוזיקה</label>
                    <input type="checkbox" id="tag3" name="tag3" value="מדיטציה">
                    <label for="tag3">מדיטציה</label>
                    <input type="checkbox" id="tag4" name="tag4" value="תפירה">
                    <label for="tag4">תפירה</label>
                    <input type="checkbox" id="tag5" name="tag5" value="נגינה">
                    <label for="tag5">נגינה</label>
                    <input type="checkbox" id="tag6" name="tag6" value="ציור">
                    <label for="tag6">ציור</label>
                    <input type="checkbox" id="tag7" name="tag7" value="יוגה">
                    <label for="tag7">יוגה</label>
                    <input type="checkbox" id="tag8" name="tag8" value="אקרובאלאנס">
                    <label for="tag8">אקרובאלאנס</label>
                    <input type="checkbox" id="tag9" name="tag9" value="בישול">
                    <label for="tag9">בישול</label>
                    <input type="checkbox" id="tag10" name="tag10" value="היכרויות">
                    <label for="tag10">היכרויות</label>
                    <input type="checkbox" id="tag11" name="tag11" value="ג'ודו">
                    <label for="tag11">ג'ודו</label>
                    <input type="checkbox" id="tag12" name="tag12" value="שח-מט">
                    <label for="tag12">שח-מט</label>
                    <input type="checkbox" id="tag13" name="tag13" value="בטבע">
                    <label for="tag13">בטבע</label>
                    <input type="checkbox" id="tag14" name="tag14" value="פיסול">
                    <label for="tag14">פיסול</label>
                    <input type="checkbox" id="tag15" name="tag15" value="בעלי חיים">
                    <label for="tag15">בעלי חיים</label>
                    <input type="checkbox" id="tag16" name="tag16" value="מקרמה">
                    <label for="tag16">מקרמה</label>
                    <input type="checkbox" id="tag17" name="tag17" value="הורות">
                    <label for="tag17">הורות</label>
                    <input type="checkbox" id="tag18" name="tag18" value="גיטרה">
                    <label for="tag18">גיטרה</label>
                </fieldset>
                <br>
                <button class="form-submit-btn" type="submit" name="submitNewHug" onclick="location.href='hugSearch.php';">צור חוג<span></span> </button>
            </section>
            <div class="stepNavButtons">
                <button id="prevBtn" onclick="nextPrev(-1)"><span class="material-icons" style="font-weight: bold;">arrow_forward</span></button>
                <button id="nextBtn" onclick="nextPrev(1)"><span class="material-icons" style="font-weight: bold;">arrow_back</span></button>
            </div>
            <!-- circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>
    </div>
</main>
<script src="js/steps.js"></script>
</body>
</html>