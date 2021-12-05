<?php 

function clean($data) {
  $data = trim($data);
  $data = stripslashes($data);

  return $data;
}

function showPrompt() {
  echo "<div class='alert alert-success'>".$_SESSION['prompt']."</div>";
}

function showError() {
  echo "<div class='alert alert-danger'>".$_SESSION['errprompt']."</div>";
}

  require_once 'Controller/FactoryPattern.php';
  $factory = new FactoryPattern();
  $Auth = $factory->make('auth');
  
  $error = " ";

  $con = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
  if(isset($_POST['update'])) {

    $oldpass = clean($_POST['oldpass']);
    $newpass = clean($_POST['newpass']);
    $confirmpass = clean($_POST['confirmpass']);

    $query = "SELECT password FROM users WHERE password = '$oldpass'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {

      if($newpass == $confirmpass) {

        $query = "UPDATE users SET password = '$newpass' WHERE userid='".$_SESSION['id']."'";

        if($result = mysqli_query($con, $query)) {

          $_SESSION['prompt'] = "Password updated.";
          $_SESSION['password'] = $newpass;
          header("location:profile.php");
          exit;

        } else {

          die("Error with the query");

        }

      } else {

        $_SESSION['errprompt'] = "The new passwords you entered doesn't match.";;

      }

    } else {

      $_SESSION['errprompt'] = "You've entered a wrong old password.";

    }

  }

  // if(isset($_SESSION['username'], $_SESSION['password'])) {

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
    

    <div class="edit-form box-left clearfix">

      <?php 
        if(isset($_SESSION['errprompt'])) {
          showError();
        }
      ?>

      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">


        <div class="form-group">
          <label for="oldpass">Old Password</label>
          <input type="password" class="form-control" name="oldpass" placeholder="Old Password" required>
        </div>


        <div class="form-group">
          <label for="newpass">New Password</label>
          <input type="password" class="form-control" name="newpass" placeholder="New Password" required>
        </div>

        <div class="form-group">
          <label for="confirmpass">Confirm Password</label>
          <input type="password" class="form-control" name="confirmpass" placeholder="Confirm Password" required>
        </div>

        <div class="form-footer">
          <a href="profile.php">Go back</a>
          <input class="btn btn-primary" type="submit" name="update" value="Update Password">
        </div>
        

      </form>
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
  mysqli_close($con);
  include_once("view/footer.php");
?>