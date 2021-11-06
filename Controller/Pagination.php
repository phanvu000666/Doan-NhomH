<?php
//UPDATE MODEL

use SmartWeb\DataBase\DBMYSQL;
use SmartWeb\DBPDO;
use SmartWeb\Phone;

class Pagination
{
    public static function createPageLinks($totalRow, $perPage, $page)
    {
        $numberPage = ceil($totalRow / $perPage);
        $next = $page;
        $prev = $page;


        $disableNext = '';
        $disablePrev = '';
        $active = '';

        // Kiểm tra next
        if ($next < $numberPage) {
            $next++;
        } else {
            $disableNext = 'disabled';
        }

        // Kiểm tra Previous
        if ($prev > 1) {
            $prev--;
        } else {
            $disablePrev = 'disabled';
        }

        $output = '
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item ' . $disablePrev . '">
                        <a class="page-link" href="?page=' . $prev . '" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    ';
        for ($i = 1; $i <= $numberPage; $i++) {
            // Kiểm tra active
            if ($page == $i) {
                $active = 'active';
            } else {
                $active = '';
            }
            $output .= '
                    <li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>
                    ';
        }

        $output .= '
                    <li class="page-item ' . $disableNext . '">
                        <a class="page-link" href="?page=' . $next . '">Next</a>
                    </li>
                </ul>
            </nav>';
        return $output;
    }

    function Search($keyword)
    {
        $key = "%$keyword%";
        //var_dump(self::$conn);
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ProductName  LIKE  ? ");
        $sql->bind_param('s', $key);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        //var_dump($items);
        return $items; //return an array

    }

    public function countAll()
    {
        $sql = "SELECT * FROM products";
        $result = self::$conn->query($sql);
        return $result->num_rows;
    }
    function Search_Paginate($start, $litmit, $keyword)
    {
        $key = "%$keyword%";
        $sql = self::$conn->prepare("SELECT * FROM products WHERE ProductName  LIKE  ? LIMIT $start,$litmit");
        $sql->bind_param('s', $key);
        $sql->execute(); //return an object
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items; //return an array


    }
}
