<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>

<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">Upload Image</button>
    </form>

    <?php
    $dir = 'uploads/'; // replace with your directory
    $files = scandir($dir);

    foreach($files as $file) {
        if($file !== '.' && $file !== '..') {
            echo "<img src='$dir$file' width='200px' height='200px'>";
        }
    }
    ?>

</body>

</html>