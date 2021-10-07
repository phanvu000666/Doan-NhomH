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
                <?php
                include 'form.php';
                ?>
            </div>
            <div class="col-xs-8">
                <h2 class="text-center">Display Information Of Products</h2>
                <?php
                include '../../controller/product.php';
                $product = new Product();
                $proList = $product->getInfor();
                //var_dump($proList);

                ?>
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= ucfirst($field['name']) ?></th>
                            <th scope="col"><?= ucfirst($field['price']) ?></th>
                            <th scope="col"><?= ucfirst($field['description']) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($proList as $key => $value) :
                            # code...
                        ?>
                            <tr>
                                <th scope="row"><?= $value['ProductID'] ?></th>
                                <td><?= $value['ProductName'] ?></td>
                                <td><?= $value['Price'] ?></td>
                                <td><?= $value['Description'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>


</html>