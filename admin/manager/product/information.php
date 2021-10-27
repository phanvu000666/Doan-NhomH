<?php

use SmartWeb\Controller\ManufactureController;
use SmartWeb\Controller\ProductController;
use SmartWeb\Controller\CategoryController;

include_once "../../controller/product-controller.php";
include_once "../../controller/manu-controller.php";
include_once "../../controller/cate-controller.php";
include "utilities.php";
$display = new ProductController;
$manu = new ManufactureController;
$cate = new CategoryController;
$display->delete();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
</head>

<body>
    <div id="demo-ajax"></div>
    <div class="container">
        <!-- Content here -->
        <div class="row">
            <div class="col-4">
                <!-- dang de trong -->
            </div>
            <div class="col-8">
                <h2 class="text-center">Display Information Of Products</h2>
                <!-- nut bam mo form -->
                <button type="button" id="btn-product" class="btn btn-primary float-right my-2" data-toggle="modal" data-target="#myModel">
                    Add
                </button>
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
                        <?= $display->display_products() ?>
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
                            <?= $manu->display_manu(); ?>
                        </p>
                        <p>
                            <label for="category">
                                Category product
                            </label>
                            <?= $cate->display_cate(); ?>
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
    <!-- Modal notification -->
    <div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- js form-->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.pack.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- add product -->
    <script>
        $(document).ready(function() {
            const save = document.getElementById('save');
            const btn = document.getElementById('btn-product');
            const btnEdit = document.querySelector('.edit-data');
            const edit = document.getElementById('edit');
            const form = document.getElementById('fproduct');

            $('#overlay').fadeIn().delay(2000).fadeOut();

            btnEdit.addEventListener("click", function() {
                // console.log(this.getAttribute('id'));
                var id = this.getAttribute('id');
                var url = 'testform.php';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: 'id=' + id,
                    success: function(data1) {
                        setTimeout(function() {
                            console.log(IsJsonString(data1));
                            if (IsJsonString(data1)) {
                                $('#demo-ajax').html(data1);
                                var obj = JSON.parse(data1.toString());
                                updateForm(obj);
                            }
                            $('#demo-ajax').html(data1);
                        }, 500);
                    },
                    error: function(e) {
                        alert("that bai");
                        console.log(e.message);
                    }
                })
            });

            // event
            save.addEventListener("click", function() {
                // console.log($("#name").val());
                var formData = new FormData(form);
                $.ajax({
                    url: 'testform.php',
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    data: formData,
                    success: function(data1) {
                        setTimeout(function() {
                            if (IsJsonString(data1)) {
                                var obj = JSON.parse(data1.toString());
                                //value back form when missing.
                                // updateForm(values);
                            }
                            // updateForm(values);
                            $('#demo-ajax').html(data1);
                        }, 500);
                    },
                    error: function(e) {
                        alert("that bai");
                        console.log(e.message);
                    }
                });
            });

            function updateForm(values) {
                // console.log(values);
                $("#name").val(values.ProductName);
                $("#price").val(values['Price']);
                $("#quantity").val(values['Quantity']);
                $("#description").val(values.Description);
                $("#origin").val(values['Origin']);
                $("#categories").val(values.CategoryID);
                $("#manufactures").val(values['ManufacturerID']);
                $('#image').val(values.ImageUrl);
                console.log($('#image').val());
            }

            function IsJsonString(str) {
                try {
                    var obj = JSON.parse(str);
                } catch (e) {
                    return false;
                }
                return true;
            }
        })
    </script>
</body>

</html>