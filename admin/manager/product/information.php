<?php
#include utilities.php.
include 'utilities.php';


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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
    <div id="demo-ajax"></div>
    <div class="container">
        <!-- Content here -->
        <div class="row">
            <div class="col-xs-4">
                <!-- dang de trong -->
            </div>
            <div class="col-xs-8">
                <h2 class="text-center">Display Information Of Products</h2>
                <!-- nut bam mo form -->
                <button type="button" id="btn-product" class="btn btn-primary float-right my-2" data-toggle="modal" data-target="#myModel">
                    Add
                </button>
                <?php $proList = $products->getInfor(); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= ucfirst($field['image']) ?></th>
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
                                <th rowspan="2" scope="row"><img class="img-thumbnail mx-auto img-fluid" src="../../images/<?= $value['ImageUrl'] ?>" alt="Hinh san pham"></th>
                                <td rowspan="2"><?= $value['ProductName'] ?></td>
                                <td rowspan="2"><?= $value['Price'] ?></td>
                                <td rowspan="2"><?= $value['Description'] ?></td>
                                <td>
                                    <a href="./handle.php?id=<?= encodeID($value['ProductID'])  ?>&handle=delete">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="button" id="<?= encodeID($value['ProductID'])  ?>" value="Edit" class="edit-data" data-toggle="modal" data-target="#myModel">
                                </td>
                            </tr>
                        <?php
                        endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- Loading -->
    <div id="overlay" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Modal form-->
    <div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">PRODUCT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo $_SERVER['PHP_SELF'];
                    ?>
                    <form action="" id="fproduct" enctype="multipart/form-data">
                        <p>
                            <label for="name">
                                Name product
                            </label>
                            <input type="text" name="name" id="name">
                        </p>
                        <p>
                            <label for="price">
                                Price Prodcut
                            </label>
                            <input type="number" name="price" id="price" min="0">
                        </p>
                        <p>
                            <label for="quantity">
                                Quantity product
                            </label>
                            <input type="number" name="quantity" id="quantity" min="0" max="10">
                        </p>
                        <p>
                            <label for="description">
                                Description product
                            </label>
                            <textarea name="description" id="description"></textarea>
                        </p>
                        <p>
                            <label for="origin">
                                Origin prodcut
                            </label>
                            <textarea name="origin" id="origin"></textarea>
                        </p>
                        <p>
                            <label for="manufacture">
                                Manufacture prodcut
                            </label>
                            <select name="manufactures" id="manufactures">
                                <option value="">Selected one</option>
                                <?php
                                $row = $manufactures->getNames();
                                foreach ($row as $key => $value) :
                                ?>
                                    <option value="<?= $value['ManufacturerID'] ?>"><?= $value['ManufacturerName'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </p>
                        <p>
                            <label for="category">
                                Category product
                            </label>
                            <select name="categories" id="categories">
                                <option value="">Selected one</option>
                                <?php
                                $row = $categories->getNames();
                                foreach ($row as $key => $value) :
                                ?>
                                    <option value="<?= $value['CategoryID'] ?>"><?= $value['CategoryName'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </p>
                        <p>
                            <input type="file" name="image" id="image">
                            <label for="image">
                                Photographic
                            </label>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save" data-toggle="modal" data-target="#notification-modal">Save</button>
                </div>
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