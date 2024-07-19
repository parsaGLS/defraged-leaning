<?php
$day="";
if ($_POST){
    $day=$_POST['day'];
}

?>



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Pick a Day</title>
</head>
<body>
<h1>Pick a Day</h1>



<form action="respond.php" method="post">
    <p>write your day</p>
    <input style="width: 500px" name="day" class="form-control form-control-lg" type="text" placeholder="Monday" value="<?php echo $day ?>" >
    <button style="margin-top: 10px" type="submit" name="GoButton" class="btn btn-primary mb-3">Go</button>

</form>















</body>
</html>