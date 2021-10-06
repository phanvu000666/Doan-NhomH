<?php
//Check current page.  against xss.
$currenPage = '/admin/manager/product/form.php';
if ($currenPage !== htmlentities($_SERVER['PHP_SELF'])) {
    //header('Location: http://web1.local/admin/manager/product/information.php');
    //exit;

}
//add files
include '../../controller/manufacture.php';
include '../../controller/category.php';
//initilize controller
$manu = new Manufacture();
$cate = new Category();

//field names
$field = [
    'name' => 'name',
    'price' => 'price',
    'quantity' => 'quantity',
    'description' => 'description',
    'origin' => 'origin',
    'manufacture' => 'manufacture',
    'category' => 'category'
];
//error and missing arrays.
$errors = [];
$missing = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //list expected fields
    $expected = ['product_name', 'price', 'quantity', 'description', 'origin', 'manufactures', 'categories'];
    //set required fields
    $required = ['product_name', 'price', 'quantity', 'description', 'origin', 'manufactures', 'categories'];
    //require processmail.php
    require '../../include/processmail.php';
    //success form.
    if (!$missing && !$errors) {
        $_POST = [];
        header('Location : http://web1.local/admin/manager/product/information.php');
        exit;
    }
}
?>
<h2>Form Add Product</h2>
<!-- check any errors or missing -->
<?php if ($missing || $errors) : ?>
    <p class="warning">Please fix the item(s) indicated</p>
<?php endif ?>

<form method="post" action="<?= $currenPage ?>">
    <p>
        <label for="product-name"><?= ucfirst($field['name']) ?> :
            <?php if (in_array('product_name', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['name'] ?></span>
            <?php endif ?>
        </label>
        <br>
        <input type="text" name="product_name" id="product-name" <?php if ($errors || $missing) {
                                                                        echo 'value="' . htmlentities($product_name) . '"';
                                                                    } ?>>
    </p>

    <p>
        <label for="price"><?= ucfirst($field['price']) ?> :
            <?php if (in_array('price', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['price'] ?></span>
            <?php endif ?>
        </label>
        <br>
        <input type="number" name="price" id="price" min="0" <?php if ($errors || $missing) {
                                                                    echo 'value="' . htmlentities($price) . '"';
                                                                } ?>>
    </p>
    <p>
        <label for="quantity"><?= ucfirst($field['quantity']) ?> :
            <?php if (in_array('quantity', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['quantity'] ?></span>
            <?php endif ?>
        </label>
        <br>
        <input type="number" name="quantity" id="quantity" min="0" max="10" <?php if ($errors || $missing) {
                                                                                echo 'value="' . htmlentities($quantity) . '"';
                                                                            } ?>>
    </p>
    <p>
        <label for="description"><?= ucfirst($field['description']) ?> :
            <?php if (in_array('description', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['description'] ?></span>
            <?php endif ?>
        </label>
        <br>
        <textarea name="description" id="description"><?php if ($errors || $missing) {
                                                            echo htmlentities($description);
                                                        } ?></textarea>
    </p>
    <p>
        <label for="origin"><?= ucfirst($field['origin']) ?> :
            <?php if (in_array('origin', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['origin'] ?></span>
            <?php endif ?>
        </label>
        <br>
        <textarea name="origin" id="origin"><?php if ($errors || $missing) {
                                                echo htmlentities($origin);
                                            } ?></textarea>
    </p>
    <p>
        <label for="manufacture"><?= ucfirst($field['manufacture']) ?> :
            <?php if (in_array('manufacture', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['origin'] ?></span>
            <?php endif ?></label>
        <select name="manufacture" id="manufacture">
            <option value="" <?php if (!$_POST || $_POST['manufacture'] == '') {
                                    echo 'selected';
                                } ?>>Selected one</option>
            <?php
            $manuName = $manu->getNames();
            foreach ($manuName as $key => $value) :
                # code...
                $id = $value['ManufacturerID'];
                $name = $value['ManufacturerName'];
            ?>
                <option value="<?= $id ?>" <?php if ($_POST && $_POST['manufacture'] == $id) {
                                                echo 'selected';
                                            } ?>><?= $name ?>
                </option>
            <?php endforeach ?>
        </select>
    </p>
    <p>
        <label for="category"><?= ucfirst($field['category']) ?> :
            <?php if (in_array('category', $missing)) : ?>
                <span class="warning">Please enter your <?= $field['origin'] ?></span>
            <?php endif ?>
        </label>
        <select name="category" id="category">
            <option value="" <?php if (!$_POST || $_POST['category'] == '') {
                                    echo 'selected';
                                } ?>>Selected one</option>
            <?php
            $cateNames = $cate->getNames();
            foreach ($cateNames as $key => $value) :
                # code...
                $id = $value['CategoryID'];
                $name = $value['CategoryName'];
            ?>
                <option value="<?= $id ?>" <?php if ($_POST && $_POST['category'] == $id) {
                                                echo 'selected';
                                            } ?>><?= $name ?>
                </option>
            <?php endforeach ?>
        </select>
    </p>
    <p>
        <input type="submit" value="Add Product" name="send">
    </p>
</form>

<pre>
    <?php if ($_POST) {
        print_r($_POST);
    } ?>
</pre>