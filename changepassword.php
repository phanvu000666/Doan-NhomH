<?php 

require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$Auth = $factory->make('auth');
$profile = $factory->make('profile');

$error = " ";

$user = null;
$_id = null;
if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $profile->findUserById($_id);
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
    <?php if ($user || !isset($_id)) { ?>
        <div class="content-text">
            <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        </div>
        <hr>
        <div class="content-profile">
            <form method="post">
                <input type="hidden" name="id" value="<?php echo $_id ?>">
                
                <div class="form-group row">
                    
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
                                <input type="submit" name= "doiMatKhau" value="Thay đổi" class="btn btn-primary change" >
                                <input type="button" value="Quay lại" class="btn btn-primary logout" onclick="document.location='profile.php'">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    <?php } else { ?>
        <div class="alert">
            <script>
                alert('User not found!');
            </script>
        </div>
    <?php } ?>
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