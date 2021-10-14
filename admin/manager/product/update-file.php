<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="update-file.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="image">Upload image:</label>
            <input type="file" name="image" id="image">
        </p>
        <p>
            <input type="submit" name="upload" value="Upload">
        </p>
    </form>

    <pre>
        <?php
            if(isset($_POST['upload']))
            {
                print_r($_FILES);
            }
        ?>
    </pre>
</body>

</html>