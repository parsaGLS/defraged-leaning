
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
<form action="respond.php" method="post">
    <p >Please inter your information:
    </p>
    <label for="city" >City:</label>
    <input id="city" name="city"  type="text" placeholder="Tehran"">
    <label for="month" >Month:</label>
    <input id="month" name="month"  type="text" placeholder="July"">
    <label for="year" >Year:</label>
    <input id="year" name="year"  type="text" placeholder="2024"">
    <br>
    <br>
    <br>
    <p>Please choose the kind of weather you experience from the list below.</p>
    <p>Choose all apply.</p>
    <label><input type="checkbox" name="weather[]" value="sunshine"> Sunshine</label><br>
    <label><input type="checkbox" name="weather[]" value="clouds"> Clouds</label><br>
    <label><input type="checkbox" name="weather[]" value="rain"> Rain</label><br>
    <label><input type="checkbox" name="weather[]" value="hail"> Hail</label><br>
    <label><input type="checkbox" name="weather[]" value="sleet"> Sleet</label><br>
    <label><input type="checkbox" name="weather[]" value="snow"> Snow</label><br>
    <label><input type="checkbox" name="weather[]" value="wind"> Wind</label><br>
    <label><input type="checkbox" name="weather[]" value="cold"> Cold</label><br>
    <label><input type="checkbox" name="weather[]" value="heat"> Heat</label><br>
    <button style="margin-top: 10px" type="submit" class="btn btn-primary mb-3">Go</button>
</form>

</body>
</html>