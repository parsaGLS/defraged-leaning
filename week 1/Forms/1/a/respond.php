<?php
$day = "";
$respond = "";

    if ($_POST) {
        $day = $_POST["day"];
        $day = strtolower($day);
    }
if ($day === "monday") {
    $respond = "Laugh on Monday, laugh for danger.";

} elseif ($day === "tuesday") {
    $respond = "Laugh on Tuesday, kiss a stranger.";
} elseif ($day === "wednesday") {
    $respond = "Laugh on Wednesday, laugh for a letter.";
} elseif ($day === "thursday") {
    $respond="Laugh on Thursday, something better.";

} else if ($day === "friday") {
  $respond="Laugh on Friday, laugh for sorrow.";
}else if ($day === "saturday") {
    $respond="Laugh on Saturday, joy tomorrow.";
}else if ($day === "sunday") {
    $respond="we are rest on sunday";
}else{
    $respond="incorrect input";
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


<form action="input.php" method="">

    <p>
        <?php
        echo $respond;

        ?>
    </p>
    <button style="margin-top: 10px" type="submit" name="GoButton" class="btn btn-primary mb-3">Back
    </button>

</form>


</body>
</html>