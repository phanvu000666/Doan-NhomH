<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));

session_start();
require_once("model/config.php");
if (isset($_POST["btn_submit"])) {
    //lấy thông tin từ các form bằng phương thức POST
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $md5Password = md5($password);
    $email = $_POST["email"];
    //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
    if ($username == "" || $md5Password == "" || $fullname == "" || $email == "") {
        echo '<script language="javascript">alert("Nhập đủ các trường để đăng kí!"); window.location="dangki.php";</script>';
    } else {
        // Kiểm tra username hoặc email có bị trùng hay không
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $con = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
        $result = mysqli_query($con, $sql);

        // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
        if (mysqli_num_rows($result) > 0) {
            echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="dangki.php";</script>';
            // Dừng chương trình
            die();
        } else {
            var_dump($username);
            var_dump($fullname);
            $sql = "INSERT INTO users (username,fullname, password, email) VALUES ('$username','$fullname','$md5Password','$email')";
            $con = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
            mysqli_query($con, $sql);
            echo '<script language="javascript">alert("Đăng kí thành công!"); window.location="dangnhap.php";</script>';

            if (mysqli_query($conn, $sql)) {
                echo "Tên đăng nhập: " . $_POST['username'] . "<br/>";
                echo "Họ và tên: " . $_POST['fullname'] . "<br/>";
                echo "Mật khẩu: " . $_POST['password'] . "<br/>";
                echo "Email đăng nhập: " . $_POST['email'] . "<br/>";
            } else {
                echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="dangki.php";</script>';
            }
        }
    }
}
?>
<html>

<head>
    <title>Login Smart Phone</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/css-auth.css">

    <!--===============================================================================================-->
</head>

<body>

    <div class="login-box">
        <h2>Sign Up</h2>
        <form method="post">
            <div class="user-box">
                <input type="text" name="username" required="">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="text" name="fullname" required="">
                <label>Fullname</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <a href="#" name="submit" value="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Sign Up
            </a>
        </form>
        <br><br>
        <div class="text-center">
            <a href="dangnhap.php">
            Do you already have an account? Log in!
            </a>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>