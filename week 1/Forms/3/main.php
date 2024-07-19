<?php
$flag=true;
if (isset($_POST["inputs"])) {
    $addText=",".$_POST["inputs"];
    $myfile = fopen("travel.txt", "a");
    fwrite($myfile, $addText);
    fclose($myfile);
    $flag=$_POST["flag"]==="true"?true:false;
}
$myfile = fopen("travel.txt", "r") ;
$travel=explode(",",fgets($myfile));
fclose($myfile);


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
    <title>How are you traveling?</title>
</head>
<body>
<h1>How are you traveling?</h1>
<form action="" method="post">
    <p >Travel takes many forms, whether across town, across the country, or around the world. Here is a list of some common modes of transportation:
    </p>
    <ul>
        <?php foreach ($travel as $value): ?>
        <li>
            <?php echo $value ?>
        </li>


        <?php endforeach;?>
    </ul>
    <?php if (true === $flag): ?>
        <label>Please add your favorite,local,or even imaginary modes of travel to the list,seprated by commas</label><br>
        <input type="hidden" name="flag" value="false"/>
    <?php endif;?>



    <?php if (false === $flag): ?>
        <label>add more?</label><br>
        <input type="hidden" name="flag" value="false"/>
    <?php endif;?>

    <input  name="inputs"  type="text"><br>


    <button style="margin-top: 10px" type="submit" class="btn btn-primary mb-3">Go</button>
</form>

</body>
</html>