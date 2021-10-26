<?php

use PhpSolutions\File\Upload;

$max = 600 * 1024;
if (isset($_POST['upload'])) {
    $detination = 'C:/Users/Administrator/Desktop/web1/admin/update/';
    require_once '../../model/update.php';
    try {
        $loader = new  Upload($detination);
        $loader->upload('image', $max, ['application/pdf'], true);
        $result = $loader->getMessages();
    } catch (Throwable $t) {
        echo $t->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // notification error when result true
    if (isset($result)) {
        echo '<ul>';
        foreach ($result as $message) {
            echo "<li>$message</li>";
        }
        echo '</ul>';
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="image">Upload image:</label>
            <input type="file" name="image[]" id="image" multiple>
        </p>
        <p>
            <input type="submit" name="upload" value="Upload">
        </p>
    </form>
</body>

</html>