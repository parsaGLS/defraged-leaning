<?php
$city = "";
$month = "";
$year = "";
$weather=[];
if ($_POST) {
    $city= $_POST['city'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $weather=$_POST['weather'];
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
    <title>How's Your Weather?</title>
</head>
<body>
<h1>How's Your Weather?</h1>

<p><?php echo "In $city in the month of $month $year, you observed the following weather:"?>
</p>

<ul>
    <?php foreach ($weather as $weathers): ?>

    <li>
        <?php echo "$weathers" ?>
    </li>

    <?php endforeach;?>
</ul>



















</body>
</html>