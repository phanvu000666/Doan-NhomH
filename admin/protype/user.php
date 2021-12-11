<?php

namespace SmartWeb\Models;

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}include{$ds}function.php");

class User extends Product
{

    // columns of table users.
    private $table_users = 'users';
    private $col_users_id = 'UserID';
    private $col_users_groupid = "GroupID";
    private $col_users_fullname = "FullName";
    private $col_users_username = "UserName";
    private $col_users_password = "PassWord";
    private $col_users_email = "Email";
    private $col_users_version = "Version";
    // columns of table groups.
    private $table_groups = 'groups';
    private $col_groups_id = 'GroupID';
    private $col_groups_name = 'GroupName';

    // private model "User".
    private static $user;

    // return the instance of "User".
    public static function getInstance()
    {
        if (self::$user !== null) {
            return self::$user;
        }
        self::$user = new self(new DBPDO());
        return self::$user;
    }


    /**
     * @param {Array} $input
     * @return bool
     */
    public function updateUser($input)
    {

        //  ============================================================ //

        // Kiểm tra giá trị truyền vào ($input).
        if (!is_array($input)) {
            return "Parameter is not array";
        }

        if (count($input) == 0) {
            return "Parameter empty";
        }

        // bắt lỗi số lượng giá trị trong mảng. ok
        if (count($input) !== 7) {
            return "Number of input parameter is not accord";
        }

        if (
            !array_key_exists($this->col_users_id, $input) ||
            !array_key_exists($this->col_groups_name, $input) ||
            !array_key_exists($this->col_users_fullname, $input) ||
            !array_key_exists($this->col_users_username, $input) ||
            !array_key_exists($this->col_users_password, $input) ||
            !array_key_exists($this->col_users_email, $input) ||
            !array_key_exists($this->col_users_version, $input)
        ) {
            return "Key value is not match";
        }


        // kiểm tra từng dữ liệu từ $input.
        if (!is_numeric($input[$this->col_users_version])) {
            return "Version is not numeric";
        }
        if (!is_numeric($input[$this->col_users_id])) {
            return "UserID is not numeric";
        }
        if (!is_string($input[$this->col_users_fullname])) {
            return "FullName is not string";
        }
        if (!is_string($input[$this->col_users_username])) {
            return "UserName is not string";
        }
        if (!is_string($input[$this->col_users_password])) {
            return "PassWord is not string";
        }
        if (!is_string($input[$this->col_users_email])) {
            return "Email is not string";
        }

        // kiểm tra độ dài giá trị nhập vào.
        if (strlen($input[$this->col_users_fullname]) < 6 || strlen($input[$this->col_users_fullname]) > 120) {
            return "FullName must be between 6 and 120";
        }
        if (strlen($input[$this->col_users_username]) < 6 || strlen($input[$this->col_users_username]) > 120) {
            return "UserName must be between 6 and 120";
        }
        if (strlen($input[$this->col_users_password]) < 6 || strlen($input[$this->col_users_password]) > 120) {
            return "PassWord must be between 6 and 120";
        }
        if (strlen($input[$this->col_users_email]) < 6 || strlen($input[$this->col_users_email]) > 120) {
            return "Email must be between 6 and 120";
        }

        // xác nhận email phù hợp.
        if (!filter_var($input[$this->col_users_email], FILTER_VALIDATE_EMAIL)) {
            return "Email is not valid";
        }


        // kiểm tra id nhập vào là số nguyên dương.
        $checka = filter_var($input[$this->col_users_id], FILTER_VALIDATE_INT);
        if (!($checka !== FALSE)) {
            return "UserID must integer value";
        }

        // kiểm tra version nhập vào là số nguyên dương.
        $checkb = filter_var($input[$this->col_users_version], FILTER_VALIDATE_INT);
        if (!($checkb !== FALSE)) {
            return "Version must integer value";
        }

        if (intval($input[$this->col_users_id]) < 1) {
            return "UserID must greater than 0";
        }
        if (intval($input[$this->col_users_version]) < 1) {
            return "Version must greater than 0";
        }

        // lấy từ giá trị truyền vào ($input).
        $GroupID = null;
        $UserID = decryptionID($input[$this->col_users_id]);
        $GroupName = $input[$this->col_groups_name];
        $FullName = $input[$this->col_users_fullname];
        $UserName = $input[$this->col_users_username];
        $PassWord = $input[$this->col_users_password];
        $Email = $input[$this->col_users_email];
        $Version = $input[$this->col_users_version];
        

        // lấy từ giá trị trong bảng users.
        $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_id` = $UserID;";
        $user_data_by_userid = $this->db->select($sql);


        if (count($user_data_by_userid) <= 0) {
            return "UserID is not exist";
        }

        $current_version = $user_data_by_userid[0][$this->col_users_version];
        $Version = decryptionID($Version);

        if ($current_version !== $Version) {
            return "Please reload page and try again.";
        }

        // kiểm tra email trùng với email cũ thì bỏ qua kiểm tra tồn tại Email và UserName.
        if ($user_data_by_userid[0][$this->col_users_email] !== $Email) {

            $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_email` = '$Email';";
            $user_data_by_email = $this->db->select($sql);
            if (count($user_data_by_email) > 0) {
                return "Email is exist";
            }
        }
       
        if ($user_data_by_userid[0][$this->col_users_username] !== $UserName) {

            $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_username` = '$UserName';";
            $user_data_by_username = $this->db->select($sql);
            if (count($user_data_by_username) > 0) {
                return "UserName is exist";
            }
        }


        // kiểm tra UserName đã tồn tại.
        // $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_username` = '$UserName';";
        // $user_data_by_username = $this->db->select($sql);
        // if (count($user_data_by_username) > 0) {
        //     return "UserName is exist";
        // }

        // kiểm tra Email đã tồn tại.
        // $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_email` = '$Email';";
        // $user_data_by_useremail = $this->db->select($sql);
        // if (count($user_data_by_useremail) > 0) {
        //     return "Email is exist";
        // }

        // kiểm tra password chỉ chấp nhận chữ cái, số và $@$!%*?&, buộc phải có ít nhất 1 ký tự đặc biệt, phải có ít nhất 1 chữ cái và 1 số, phải có chữ hoa chữ thường.
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $PassWord)) {
            return "Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter, one number and one special character";
        }

        // lấy groups để so sánh với groupName.
        $sql = "SELECT * FROM `$this->table_groups`;";
        $groups_data = $this->db->select($sql);

        // so sánh và lấy groupID, nếu không tồn tại thì trả về "Group not found".
        if (is_array($groups_data)) {
            // so sánh với GroupName hoặc GroupID trong table groups.
            foreach ($groups_data as $group) {
                if (
                    $group[$this->col_groups_name] == $GroupName ||
                    $group[$this->col_groups_id] == decryptionID($GroupName)
                ) {
                    $GroupID = $group[$this->col_groups_id];
                    break;
                }
            }
            // nếu không tồn tại thì trả về "Group not found".
            if ($GroupID == null) {
                return "Group not found";
            }
        } 

        // tạo câu truy vấn.
        $sql =
            "UPDATE `$this->table_users` SET
        `$this->col_users_groupid` = :$this->col_users_groupid,
        `$this->col_users_fullname` = :$this->col_users_fullname,
        `$this->col_users_username` = :$this->col_users_username,
        `$this->col_users_password` = :$this->col_users_password,
        `$this->col_users_email` = :$this->col_users_email,
        `$this->col_users_version` = :$this->col_users_version
        WHERE `$this->col_users_id` = :$this->col_users_id;";

        // tạo data chỉnh một người dùng.
        $data = [];
        $data[$this->col_users_id] = htmlspecialchars($UserID);
        $data[$this->col_users_groupid] = htmlspecialchars($GroupID);
        $data[$this->col_users_fullname] = htmlspecialchars($FullName);
        $data[$this->col_users_username] = htmlspecialchars($UserName);
        $data[$this->col_users_password] =  md5($PassWord);
        $data[$this->col_users_email] = htmlspecialchars($Email);
        $data[$this->col_users_version] = htmlspecialchars($Version + 1);

        $result =  $this->db->notSelect($sql, $data);

        return $result;
    }

    /**
     * @param {Array} $input
     * @return bool
     */
    public function addUser($input)
    {
        //  ============================================================ //

        // Kiểm tra giá trị truyền vào ($input).
        if (!is_array($input)) {
            return "Parameter is not array";
        }

        if (count($input) == 0) {
            return "Parameter empty";
        }

        // bắt lỗi số lượng giá trị trong mảng. ok
        if (count($input) !== 5) {
            return "Number of input parameter is not accord";
        }

        if (
            !array_key_exists($this->col_groups_name, $input) ||
            !array_key_exists($this->col_users_fullname, $input) ||
            !array_key_exists($this->col_users_username, $input) ||
            !array_key_exists($this->col_users_password, $input) ||
            !array_key_exists($this->col_users_email, $input)
        ) {
            return "Key value is not match";
        }

        // lấy từ giá trị truyền vào ($input).
        $GroupID = null;
        $GroupName = $input[$this->col_groups_name];
        $FullName = $input[$this->col_users_fullname];
        $UserName = $input[$this->col_users_username];
        $PassWord = $input[$this->col_users_password];
        $Email = $input[$this->col_users_email];
        $Version = 0;

        // kiểm tra từng dữ liệu từ $input.
        if (!is_string($FullName)) {
            return "FullName is not string";
        }
        if (!is_string($UserName)) {
            return "UserName is not string";
        }
        if (!is_string($PassWord)) {
            return "PassWord is not string";
        }
        if (!is_string($Email)) {
            return "Email is not string";
        }

        // kiểm tra độ dài giá trị nhập vào.
        if (strlen($FullName) < 6 || strlen($FullName) > 120) {
            return "FullName must be between 6 and 120";
        }
        if (strlen($UserName) < 6 || strlen($UserName) > 120) {
            return "UserName must be between 6 and 120";
        }
        if (strlen($PassWord) < 6 || strlen($PassWord) > 120) {
            return "PassWord must be between 6 and 120";
        }
        if (strlen($Email) < 6 || strlen($Email) > 120) {
            return "Email must be between 6 and 120";
        }

        // xác nhận email phù hợp.
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            return "Email is not valid";
        }

        // kiểm tra UserName đã tồn tại.
        $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_username` = '$UserName';";
        $user_data_by_username = $this->db->select($sql);
        if (count($user_data_by_username) > 0) {
            return "UserName is exist";
        }

        // kiểm tra Email đã tồn tại.
        $sql = "SELECT * FROM `$this->table_users` WHERE `$this->col_users_email` = '$Email';";
        $user_data_by_useremail = $this->db->select($sql);
        if (count($user_data_by_useremail) > 0) {
            return "Email is exist";
        }

        // kiểm tra password chỉ chấp nhận chữ cái, số và $@$!%*?&, buộc phải có ít nhất 1 ký tự đặc biệt, phải có ít nhất 1 chữ cái và 1 số, phải có chữ hoa chữ thường.
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $PassWord)) {
            return "Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter, one number and one special character";
        }

        // lấy groups để so sánh với groupName.
        $sql = "SELECT * FROM `$this->table_groups`;";
        $groups_data = $this->db->select($sql);

        // so sánh và lấy groupID, nếu không tồn tại thì trả về "Group not found".
        if (is_array($groups_data)) {
            // so sánh với GroupName hoặc GroupID trong table groups.
            foreach ($groups_data as $group) {
                if (
                    $group[$this->col_groups_name] == $GroupName ||
                    $group[$this->col_groups_id] == decryptionID($GroupName)
                ) {
                    $GroupID = $group[$this->col_groups_id];
                    break;
                }
            }
            // nếu không tồn tại thì trả về "Group not found".
            if ($GroupID == null) {
                return "Group not found";
            }
        } else {
            // nếu không phải là một mảng.
            return "Group Name is not accord";
        }

        // tạo câu truy vấn.
        $sql =
            "INSERT INTO $this->table_users(
        $this->col_users_groupid,
        $this->col_users_fullname,
        $this->col_users_username,
        $this->col_users_password,
        $this->col_users_email,
        $this->col_users_version)
        VALUES(
        :$this->col_users_groupid,
        :$this->col_users_fullname,
        :$this->col_users_username,
        :$this->col_users_password,
        :$this->col_users_email,
        :$this->col_users_version);";

        // tạo data thêm một người dùng.
        $data = [];
        $data[$this->col_users_groupid] = htmlspecialchars($GroupID);
        $data[$this->col_users_fullname] = htmlspecialchars($FullName);
        $data[$this->col_users_username] = htmlspecialchars($UserName);
        $data[$this->col_users_password] = md5($PassWord);
        $data[$this->col_users_email] = htmlspecialchars($Email);
        $data[$this->col_users_version] = htmlspecialchars($Version);

        $result =  $this->db->notSelect($sql, $data);

        return $result;
    }

    /**
     * @todo: Lấy và Tạo danh sách người dùng.
     * @return string
     */
    public function getListUser()
    {
        $sql = "SELECT * FROM `$this->table_users` JOIN `$this->table_groups`
        ON `$this->table_groups`.`$this->col_groups_id` = `$this->table_users`.`$this->col_groups_id`;";
        $data = $this->db->select($sql);

        if (!is_array($data)) {
            $data = [];
        }
        $result =
            <<< Gryphon
            <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">GroupName</th>
                  <th scope="col">FullName</th>
                  <th scope="col">UserName</th>
                  <th scope="col">Email</th>
                  <th scope="col">Version</th>
                  <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
        Gryphon;

        if (count($data) > 0) {
            for ($i = 0; $i < count($data); $i++) {
                $encode_user_id = encodeID($data[$i][$this->col_users_id]);
                $result .=
                    <<< Gryphon
                    <tr data-uid="$encode_user_id">
                        <th scope="row">{$i}</th>
                        <td>{$data[$i][$this->col_groups_name]}</td>
                        <td>{$data[$i][$this->col_users_fullname]}</td>
                        <td>{$data[$i][$this->col_users_username]}</td>
                        <td>{$data[$i][$this->col_users_email]}</td>
                        <td>{$data[$i][$this->col_users_version]}</td>
                        <td class="user-handle d-flex">
                            <button data-uid="$encode_user_id" class="btn btn-sm btn-info btn-icon-split my-1 update_user mr-md-1 mr-lg-1" type="button" data-toggle="modal" data-target="#userModalInfo">
                                <span class="update_user_icon">
                                    <i style="width: 2.5vw;" class="fas fa-edit update_user_icon_i"></i>
                                </span>
                            </button>
                            <form method="post" action="/admin/user-management-page" >
                                <input type="hidden" name="UserID" value="$encode_user_id">
                                <button class="btn btn-sm btn-danger btn-icon-split my-1 mr-md-1 mr-lg-1 delete_user" type="submit">
                                    <span class="delete_user_icon">
                                        <i style="width: 2.5vw;" class="fas fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                Gryphon;
            }
        }

        $result .= <<< Gryphon
        </tbody>
        Gryphon;

        return $result;
    }

    /**
     * @todo: Lấy một người dùng.
     * @return string
     */
    public function getFormUserInfo($input)
    {
        // Kiểm tra giá trị truyền vào ($input).
        if (!is_array($input)) {

            $data_group = $this->getGroups();
            $result =
                <<< Gryphon
                    <div class="form-group">
                        <input name="FullName" type="text" class="form-control" placeholder="Full name"">
                    </div>
                    <div class="form-group">
                        <input name="UserName" type="text" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input name="PassWord" type="password" class="form-control" placeholder="PassWord" required>
                    </div>
                    <div class="form-group">
                        <input name="Email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        {$data_group}
                    </div>
                        <input name="action" type="hidden" value="add">
                    <div class="alert" role="alert" id="alertWarningUserModelInfo"></div>
                Gryphon;

            return [$result];
        }

        // kiểm tra số lượng phần tử trong mảng ($input).
        if (count($input) == 0) {
            return "Input empty";
        }

        // bắt lỗi số lượng giá trị trong mảng. ok
        if (count($input) !== 1) {
            return "Number of input parameter is not accord";
        }

        // kiểm tra key có phải là UserID không.
        if (!array_key_exists($this->col_users_id, $input)) {
            return "Key value is not match";
        }

        // kiểm tra id có phải là số không.
        if (!is_numeric($input[$this->col_users_id])) {
            return "ID is not number";
        }

        // kiểm tra id nhập vào là số nguyên dương.
        $check = filter_var($input[$this->col_users_id], FILTER_VALIDATE_INT);
        if (!($check !== FALSE)) {
            return "Id must integer value";
        }

        // giải mã id.
        $id = decryptionID($input[$this->col_users_id]);

        if (!is_numeric($id)) {
            return "Wrong ID";
        }




        $sql = "SELECT * FROM `$this->table_users` JOIN `$this->table_groups`
        ON `$this->table_groups`.`$this->col_groups_id` = `$this->table_users`.`$this->col_groups_id`
        WHERE `$this->col_users_id` = $id;";
        $data = $this->db->select($sql);

        if (count($data) === 0) {
            return "User not found";
        }

        $GroupID = $data[0][$this->col_users_groupid];
        $encode_version = encodeID($data[0][$this->col_users_version]);
        $data_group = $this->getGroups($GroupID);

        $result =
            <<< Gryphon
                <div class="form-group">
                    <input name="FullName" type="text" class="form-control" placeholder="Full name" value="{$data[0][$this->col_users_fullname]}">
                  </div>
                  <div class="form-group">
                    <input name="UserName" type="text" class="form-control" placeholder="Username" value="{$data[0][$this->col_users_username]}" required>
                  </div>
                  <div class="form-group">
                    <input name="PassWord" type="password" class="form-control" placeholder="PassWord" required>
                  </div>
                  <div class="form-group">
                    <input name="Email" type="email" class="form-control" placeholder="Email" value="{$data[0][$this->col_users_email]}" required>
                  </div>
                  <div class="form-group">
                    {$data_group}
                  </div>
                  <input name="action" type="hidden" value="edit">
                  <input name="UserID" type="hidden" value="{$input[$this->col_users_id]}">
                  <input name="Version" type="hidden" value="{$encode_version}">
                <div class="alert" role="alert" id="alertWarningUserModelInfo"></div>
        Gryphon;

        return $result;
    }

    /**
     * @todo: Xóa một người dùng.
     * @return string
     */
    public function deleteUser($id = null)
    {


        if (!is_numeric($id)) {
            return [null, "Id must be numeric"];
        }

        // kiểm tra id nhập vào là số nguyên dương.
        $check = filter_var($id, FILTER_VALIDATE_INT);
        if (!($check !== FALSE)) {
            return [null, "Id must integer value"];
        }

        // kiểm tra id nhập vào là số nguyên dương.
        if ($id < 0) {
            return [null, "Id value is negative"];
        }

        $id = decryptionID($id);

        if (!is_numeric($id)) {
            return [null, "Wrong ID"];
        }

        // giải mã id.
        $sql = "SELECT * FROM `$this->table_users` JOIN `$this->table_groups`
         ON `$this->table_groups`.`$this->col_groups_id` = `$this->table_users`.`$this->col_groups_id`
         WHERE `$this->col_users_id` = $id;";
        $data = $this->db->select($sql);

        if (count($data) === 0) {
            return [null, "User not found"];
        }

        $sql = "DELETE FROM `$this->table_users` WHERE `$this->col_users_id` = :$this->col_users_id";

        $result =  $this->db->notSelect($sql, [$this->col_users_id => $id]);

        return [$result];
    }

    /**
     * @todo: Lấy và Tạo danh sách groups.
     * @return string
     */
    public function getGroups($selected = 0)
    {

        if (!is_numeric($selected)) {
            return "Selected must be numeric";
        }

        $sql = "SELECT * FROM `$this->table_groups`;";
        $data = $this->db->select($sql);

        if (count($data) === 0) {
            return "No group data";
        }

        $result =
            <<< Gryphon
            <label for="SelectGroupName">Group name</label>
            <select name="GroupName" id="SelectGroupName" class="form-control">    
            Gryphon;


        if (count($data) > 0) {
            for ($i = 0; $i < count($data); $i++) {
                $encode_group_id = encodeID($data[$i]['GroupID']);

                if ($selected == $data[$i]['GroupID']) {
                    $result .=
                        <<< Gryphon
                        <option value="$encode_group_id" selected>{$data[$i]['GroupName']}</option>
                        Gryphon;
                } else {
                    $result .=
                        <<< Gryphon
                        <option value="$encode_group_id">{$data[$i]['GroupName']}</option>
                        Gryphon;
                }
            }
        }
        $result .=
            <<< Gryphon
            </select>
            Gryphon;


        return $result;
    }

    public function startTransaction()
    {
        $this->db->getConnect()->beginTransaction();
    }

    public function rollBack()
    {
        $this->db->getConnect()->rollback();
    }
}
