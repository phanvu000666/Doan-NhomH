<?php

require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$profile = $factory->make('profile');

if (isset($_POST['doiMatKhau'])) {
  $id = $_POST['id'];
  $passold = $_POST['passwordOld'];
  $passnew1 = $_POST['passwordNew1'];
  $passnew2 = $_POST['passwordNew2'];
  $mkCu = $_POST['matKhauCu'];
  // $pass = password_hash($passnew1, PASSWORD_DEFAULT);
  // $profile->updatePass($pass, $id);
  if ($passold == "" || $passnew1 == "" || $passnew2 == "") {
    echo "<script>alert('Nhập đầy đủ thông tin trước!');window.location.href='./changepassword.php'</script>";
  } else {
    if (strlen($passnew1) < 6 || strlen($passnew2) < 6) {
      echo "<script>alert('Mật khẩu phải lớn hơn 6 kí tự!');window.location.href='./changepassword.php'</script>";
    } else {
      if ($passnew1 == $passnew2) {
        $pass = password_hash($passnew1, PASSWORD_DEFAULT);
        $profile->updatePass($pass, $id);
        echo "<script>alert('Đổi mật khẩu thành công!');window.location.href='../profile.php'</script>";
      } else {
        echo "<script>alert('Xác nhận mật khẩu sai!');</script>";
      }
    }
  }
}

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Change Password</title>

  <link href="./css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/profile-css.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php include 'view/header.php'; ?>

  <section>

    <div class="product-big-title-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="product-bit-title text-center">
              <h2>Chang Password</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="content row">

      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="content-text">
          <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        </div>
        <hr>
        <div class="content-profile">
          <form method="post">


            <div class="form-group row">
              <?php
              $query = "SELECT * FROM users WHERE UserId = " . $_SESSION['id'] . "";;
              $con = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
              if ($result = mysqli_query($con, $query)) {

                $row = mysqli_fetch_assoc($result);
                // echo "<div class='info' name='info'> <span>".$row['UserName']."</span></div>";
              } else {

                die("Error with the query in the database");
              }
              ?>
              <input type="hidden" name="id" value="<?php echo $row['UserID'] ?>">
              <input type="hidden" name="matKhauCu" value="<?php echo $row['PassWord'] ?>">

              <div id="popup1" class="overlay">
                <div class="popup">
                  <h3>Đổi mật khẩu</h3>
                  <a href="#" class="close">&times;</a>
                  <div class="ct-txt">
                    <div class="form-group">
                      <label class="passOld" for="passwordOld">Password cũ: </label>
                      <input type="password" name="passwordOld" placeholder="Password cũ">
                    </div>
                    <div class="form-group">
                      <label class="passNew" for="">Password mới: </label>
                      <input type="password" name="passwordNew1" placeholder="Password mới">
                    </div>
                    <div class="form-group">
                      <label class="passNew2" for="">Xác nhận password: </label>
                      <input type="password" name="passwordNew2" placeholder="Xác nhận password">
                    </div>
                    <input type="submit" name="doiMatKhau" value="Thay đổi" class="btn btn-primary change">
                    <input type="button" value="Quay lại" class="btn btn-primary logout" onclick="document.location='profile.php'">
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>

  </section>


  <script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>

<?php
// }
// } else {
//   header("location:profile.php");
// }

// unset($_SESSION['errprompt']);
// mysqli_close($con);
include_once("view/footer.php");
?>