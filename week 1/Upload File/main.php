<?php
$errors = [];
$fileDescription = "";
$fileName = "";
$file = [];
if (!empty($_POST)) {
    $fileDescription = $_POST["fileDescription"];
    $fileName = $_POST["fileName"];
    $file = isset($_FILES['file']) ? $_FILES['file'] : null;
    if ($fileDescription === "") {
        $errors[] = "please describe your file";
    }
    if ($fileName === "") {
        $errors[] = "please enter your file name";
    } else {
        $flag = true;
        $fileList = scandir('./image');
        foreach ($fileList as $fileLists) {
            if (explode('.', $fileLists)[0] == $fileName) {
                $errors[] = "this name is in files";
                $flag = false;
            }
        }
        if ($flag) {
            $fileList = scandir('./text');
            foreach ($fileList as $fileLists) {
                if (explode('.', $fileLists)[0] == $fileName) {
                    $errors[] = "this name is in files";
                }
            }
        }
    }
    if (empty($file)) {
        $errors[] = "please choose youe file";
    } elseif (explode("/", $file["type"])[0] == "image") {
        if ($file["size"] > 1048576) {
            $errors[] = "your file is too large";
        }
    } elseif (explode("/", $file["type"])[0] == "text") {
        if ($file["size"] > 524288) {
            $errors[] = "your file is too large";
        }
    } else {
        $errors[] = "your file is invalid";
    }
}
if (empty($errors)) {
    if (!file_exists("image")) {
        mkdir('image');
    }
    if (!file_exists("text")) {
        mkdir('text');

    }
    if (!empty($file)) {

        if (explode("/", $file["type"])[0] == "text") {
            move_uploaded_file($file["tmp_name"], "text/" . $fileName . ".txt");
        }
        if (explode("/", $file["type"])[0] == "image") {
            move_uploaded_file($file["tmp_name"], "image/" . $fileName . "." . explode("/", $file["type"])[1]);
        }
    }
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
    <title>submit file</title>
</head>
<body>
<h1>submit file</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<form action="" method="post" enctype="multipart/form-data">
    <label for="file">Choose file to upload:</label>
    <input type="file" id="file" name="file" required><br><br>

    <label for="fileName">File Name:</label>
    <input type="text" id="fileName" name="fileName" placeholder="e.g., National Card"><br><br>

    <label for="fileDescription">File Description:</label>
    <textarea id="fileDescription" name="fileDescription" placeholder="A brief description of the file" rows="4"
              cols="50"></textarea><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>