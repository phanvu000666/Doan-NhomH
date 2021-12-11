<?php
require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$profile = $factory->make('profile');


if (!empty($_POST['submit'])) {
  $id = $_POST['id'];
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  if ($fullname == "" || $email == "") {
    echo '<script>alert("Nhập đủ các thông tin trước!");window.location.href="../editprofile.php"</script>';
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo '<script>alert("Email không đúng định dạng!");window.location.href="../editprofile.php"</script>';
    } else {
      $profile->updateUsers($fullname, $email, $id);
      echo '<script>alert("Cập nhật thành công!");window.location.href="../profile.php"</script>';
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

  <title>Edit Profile</title>

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
              <h2>Edit Profile</h2>
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
              <label class="col-md-3" for="username">Tên đăng nhập: </label>
              <input class="form-control col-md-3" name="username" placeholder="UserName" value='<?php if (!empty($row['UserName'])) echo $row['UserName']; ?>' readonly>
            </div>
            <div class="form-group row">
              <label class="col-md-3" for="fullname">Họ tên: </label>
              <input class="form-control col-md-3" name="fullname" placeholder="Fullname" value="<?php if (!empty($row['FullName'])) echo $row['FullName']; ?>">
            </div>
            <div class="form-group row">
              <label class="col-md-3" for="email">Email: </label>
              <input class="form-control col-md-3" name="email" placeholder="Email" value="<?php if (!empty($row['Email'])) echo $row['Email']; ?>">
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-primary save">Lưu</button>
            <input type="button" value="Quay về" class="btn btn-primary logout" onclick="document.location='profile.php'">
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

// } else {
//   header("location:profile.php");
// }

include_once("view/footer.php");
?>