<?php

namespace SmartWeb\Controller;

use SmartWeb\Models\ObjectAssembler;
use SmartWeb\Models\Category;

class CategoryController
{
    private Category $cate;
    public function __construct(string $conf)
    {
        $assembler = new ObjectAssembler($conf);
        $this->cate = $assembler->getComponent(Category::class);
    }

    public function display_cate()
    {
        $result = $this->cate->getCategory();

        $select = <<< Select
            <select name="CategoryID" id="CategoryID">
            <option value="">Selected one</option>
        Select;
        foreach ($result as $key => $value) {
            $select .= <<< Select
            <option value="{$value['CategoryID']}">{$value['CategoryName']}</option>
        Select;
        }
        $select .= <<< Select
        </select>
        Select;
        return $select;
    }


    // hien thi danh sach categories
    public function display_category()
    {
        //initialize
        $result = $this->cate->getCategory();
        $body_table = <<< Gryphon
        <thead>
            <tr>
                <th class="category_id">ID</th>
                <th class="category_name">Image</th>
                <th class="category_handle">Handle</th>
            </tr>
        </thead> <!-- End Cart Table Head -->
        <tbody>
        Gryphon;
        foreach ($result as $key => $value) {

            $encode = encodeID($value['CategoryID']);
            $body_table .= <<< Gryphon
            <tr class="single-product" >
                <td class="category-id">{$encode}</td>
                <td class="category-name">{$value['CategoryName']}</td>
                <td class="category-handle">
                   <div><button
                   style="all:unset"  data-cateid="{$encode}" type="button" class="edit-data edit-category" data-toggle="modal" data-target="#editCategory">
                   <span class="btn btn-info btn-icon-split"  data-cateid="{$encode}">
                            <span class="icon text-white-50"  data-cateid="{$encode}">
                                <svg  data-cateid="{$encode}" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path  data-cateid="{$encode}" d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path  data-cateid="{$encode}" fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                            </span>
                    </span>
                   </button>
                        <button type="button" class="btn btn-danger btn-icon-split deletecategory" data-cateid="{$encode}">
                            <span class="icon text-white-50"  data-cateid="{$encode}">
                                <i class="fas fa-trash"  data-cateid="{$encode}"></i>
                            </span>
                        </button>
                    </div>
                </td>
            </tr>
            Gryphon;
        }
        // <a href="{$_SERVER['PHP_SELF']}?ProductID={$encode}&handle=delete"><i class="fa fa-trash-o 1"></i></a>
        $body_table .= <<< Gryphon
        </tbody>
        Gryphon;
        echo $body_table;
    }

    public function displayOneCateByJsonData()
    {
        $result = false;
        // kiem tra thuoc kieu delete.
        if (
            isset($_POST['id']) &&
            isset($_POST['action']) &&
            $_POST['action'] === "getone"
        ) {
            // lay id va delete.
            $id = decryptionID($_POST['id']);
            $id = (int) $id;
            $result = $this->cate->getOne($id);

            // neu delete thanh cong tra ve json bao thanh cong.
            if (count($result) > 0) {
                echo json_encode(array(
                    'success' => true,
                    'message' => "Get cate successfully!",
                    'data' => $result[0]
                ));
                die;
            } else {
                // neu delete khong thanh cong tra ve json bao loi.
                echo json_encode(array(
                    'success' => false,
                    'message' => "Error get category!"
                ));
                die;
            }
        }
    }

    public function delete()
    {
        $result = false;
        // kiem tra thuoc kieu delete.
        if (
            isset($_POST['id']) &&
            isset($_POST['action']) &&
            $_POST['action'] === "delete"
        ) {
            // lay id va delete.
            $id = decryptionID($_POST['id']);
            $result = $this->cate->deleteOne($id);

            // neu delete thanh cong tra ve json bao thanh cong.
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => "Delete successfully!"
                ));
                die;
            } else {
                // neu delete khong thanh cong tra ve json bao loi.
                echo json_encode(array(
                    'success' => false,
                    'message' => "Error delete category!"
                ));
                die;
            }
        }
    }
    public function update()
    {
        $result = false;
        // var_dump($_POST);
        // kiem tra thuoc kieu update.
        if (
            isset($_POST['CategoryID']) &&
            isset($_POST['action']) &&
            $_POST['action'] === "update"
        ) {
            $ver = $this->cate->getVersion($_POST['CategoryID']);
            if ($ver[0]['Version'] == $_POST['Version']) {
            // lay id va update.
            $result = $this->cate->updateOne($_POST);
                if ($result == true) {
                    $this->cate->setVersion($_POST['CategoryID']);
                }
            }
            // neu update thanh cong tra ve json bao thanh cong.
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => "Update successfully!"
                ));
                die;
            } else {
                // neu update khong thanh cong tra ve json bao loi.
                echo json_encode(array(
                    'success' => false,
                    'message' => "Error update category!"
                ));
                die;
            }
        }
    }
    public function insert()
    {
        $result = false;
       
        // kiem tra thuoc kieu insert.
        if (
            isset($_POST['CategoryName']) &&
            isset($_POST['Position']) &&
            isset($_POST['action']) &&
            $_POST['action'] === "add"
        ) {
            var_dump($_POST);
            // lay id va insert.
            $result = $this->cate->insertOne($_POST);

            // neu insert thanh cong tra ve json bao thanh cong.
            if ($result) {
                echo json_encode(array(
                    'success' => true,
                    'message' => "Insert successfully!"
                ));
                
                die;
            } else {
                // neu insert khong thanh cong tra ve json bao loi.
                echo json_encode(array(
                    'success' => false,
                    'message' => "Error insert category!"
                ));
                die;
            }
        }
    }
}
