<?php
#include utilities.php.
include 'utilities.php';
phpinfo();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <!-- Content here -->
        <div class="row">
            <div class="col-xs-4">

            </div>
            <div class="col-xs-8">
                <h2 class="text-center">Display Information Of Products</h2>

                <button type="button" class="btn btn-primary btn-lg pull-right" style="margin: 10px 0px">Add</button>


                <?php $proList = $product->getInfor(); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= ucfirst($field['name']) ?></th>
                            <th scope="col"><?= ucfirst($field['price']) ?></th>
                            <th scope="col"><?= ucfirst($field['description']) ?></th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proList as $key => $value) : ?>
                            <tr>
                                <th rowspan="2" scope="row"><?= $value['ProductID'] ?></th>
                                <td rowspan="2"><?= $value['ProductName'] ?></td>
                                <td rowspan="2"><?= $value['Price'] ?></td>
                                <td rowspan="2"><?= $value['Description'] ?></td>
                                <td>
                                    <a href="./handle.php?id=<?= encodeID($value['ProductID'])  ?>&handle=delete">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="./handle.php?id=<?= encodeID($value['ProductID'])  ?>">Edit</a>
                                </td>
                            </tr>
                        <?php
                        endforeach ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <?php
    function encodeID($id)
    {
        $randomFirst = random_int(1000, 9999);
        $randomTail =  random_int(1000, 9999);
        return $randomFirst . $id . $randomTail;
    }
    ?>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>


</html>