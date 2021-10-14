<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
require_once("{$base_dir}model{$ds}pdo_con.php");

class Product extends My_PDO
{
    private static $product;
    public static function getInstance()
    {
        if (self::$product) {
            return self::$product;
        }
        self::$product = new self();
        return self::$product;
    }

    function getInfor()
    {
        $stmt = parent::getInstance()->prepare("SELECT ProductID,ProductName, Price, `Description`, ImageUrl FROM products");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getProduct($id = null)
    {
        $stmt = parent::getInstance()->prepare("SELECT * FROM products where ProductID = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function deleteProduct($id)
    {
        $stmt = parent::getInstance()->prepare("DELETE FROM products WHERE ProductID = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function insertProduct(...$arg)
    {
        $image = "iphone.png";
        $stmt = parent::getInstance()->prepare("INSERT INTO products(ProductName, Price, Quantity, Description, Origin, ManufacturerID, CategoryID, ImageUrl) VALUES(?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $arg[0], PDO::PARAM_STR, 255);
        $stmt->bindParam(2, $arg[1], PDO::PARAM_INT);
        $stmt->bindParam(3, $arg[2], PDO::PARAM_INT);
        $stmt->bindParam(4, $arg[3], PDO::PARAM_STR);
        $stmt->bindParam(5, $arg[4], PDO::PARAM_STR, 255);
        $stmt->bindParam(6, $arg[5], PDO::PARAM_INT);
        $stmt->bindParam(7, $arg[6], PDO::PARAM_INT);
        $stmt->bindParam(8, $image, PDO::PARAM_STR, 255);
        return $stmt->execute();
    }

    function updateProduct(...$arg)
    { //$name, $price, $quantity, $description, $origin, $manufactures, $categories,$image
        print_r($arg);
        $stmt = parent::getInstance()->prepare("UPDATE products 
                                                SET 
                                                ProductName=?,
                                                Price=?,
                                                Quantity=?,
                                                `Description`=?,
                                                Origin=?   ,
                                                ManufacturerID=?,
                                                CategoryID=?,
                                                ImageUrl=?
                                                WHERE ProductID=?");
        $stmt->bindParam(1, $arg[0], PDO::PARAM_STR, 255);
        $stmt->bindParam(2, $arg[1], PDO::PARAM_INT);
        $stmt->bindParam(3, $arg[2], PDO::PARAM_INT);
        $stmt->bindParam(4, $arg[3], PDO::PARAM_STR, 1000);
        $stmt->bindParam(5, $arg[4], PDO::PARAM_STR, 255);
        $stmt->bindParam(6, $arg[5], PDO::PARAM_INT);
        $stmt->bindParam(7, $arg[6], PDO::PARAM_INT);
        $stmt->bindParam(8, $arg[7], PDO::PARAM_STR, 255);
        $stmt->bindParam(9, $arg[8], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function uploadPhoto($file)
    {
        if (!empty($file)) {
            $fileTempPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileNameCmps = explode('.', $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $allowedExtn = ["jpg", "png", "gif", "jpeg"];
            if (in_array($fileExtension, $allowedExtn)) {
                $uploadFileDir = getcwd() . '../../../images/';
                $destFilePath = $uploadFileDir . $newFileName;
                if (move_uploaded_file($fileTempPath, $destFilePath)) {
                    return $newFileName;
                }
            }
        }
    }
}
