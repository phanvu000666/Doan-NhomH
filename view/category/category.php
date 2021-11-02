<?php
    include_once("Controller/Category.php");
    $cate = new Category();
    $resultc = $cate->getCategory();
    // var_dump($result);
    foreach ($resultc as $row) {
        echo "<a href=\"index.php?mod=category&act=resultcategory&id={$row['CategoryID']}\">{$row['CategoryName']}</a>";
    }
