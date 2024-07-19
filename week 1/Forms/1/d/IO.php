<?php
$day = "";
$respond = "";
$flag = false;
if (!empty($_POST)) {
    $day = isset($_POST["day"]) ? $_POST["day"] : "";
    $flag = $_POST["flag"] == "true" ? true : false;
    $day = strtolower($day);
}
switch ($day) {

    case "monday":
        $respond = "Laugh on Monday, laugh for danger.";
        break;
    case "tuesday":
        $respond = "Laugh on Tuesday, kiss a stranger.";
        break;
    case "wednesday":
        $respond = "Laugh on Wednesday, laugh for a letter.";
        break;
    case "thursday":
        $respond = "Laugh on Thursday, something better.";
        break;
    case "friday":
        $respond = "Laugh on Friday, laugh for sorrow.";
        break;
    case "saturday":
        $respond = "Laugh on Saturday, joy tomorrow.";
        break;
    case "sunday":
        $respond = "we are rest on sunday";
        break;
    default:
        $respond = "incorrect input";
        break;
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Pick a Day</title>
</head>
<body>
<h1>Pick a Day</h1>


<?php if (!$flag): ?>
    <form action="" method="post">
        <p>write your day</p>


        <select name="day" class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="monday">Monday</option>
            <option value="tuesday">tuesday</option>
            <option value="wednesday">wednesday</option>
            <option value="thursday">thursday</option>
            <option value="friday">friday</option>
            <option value="saturday">saturday</option>
            <option value="sunday">sunday</option>
        </select>


        <!--        <input style="width: 500px" name="day" class="form-control form-control-lg" type="text" placeholder="Monday"-->
        <!--               value="--><?php //echo $day ?><!--">-->
        <button style="margin-top: 10px" type="submit" name="GoButton" class="btn btn-primary mb-3">Go</button>
        <input type="hidden" name="flag" value="true"/>
    </form>
<?php endif; ?>
<?php if ($flag): ?>
    <form action="" method="post">
        <p>
            <?php echo $respond; ?>
        </p>
        <input type="hidden" name="flag" value="false"/>
        <button style="margin-top: 10px" type="submit" name="GoButton" class="btn btn-primary mb-3">Back
        </button>
    </form>
<?php endif; ?>
</body>
</html>