<?php


require_once 'Controller/FactoryPattern.php';
$factory = new FactoryPattern();
$Auth = $factory->make('auth');

$error = " ";

//    if ($user = $Auth->auth($users['username'], $users['password'])) {

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Profile</title>

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
              <h2>My Profile</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="content row">

      <div class="col-md-3"></div>
      <div class="col-md-6">

        
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
              <label class="col-md-3" for="username">Fullname: </label>
              <input class="form-control col-md-3" name="fullname" placeholder="Fullname" value='<?php if (!empty($row['FullName'])) echo $row['FullName']; ?>' readonly>
            </div>
            <div class="form-group row">
              <label class="col-md-3" for="username">Email: </label>
              <input class="form-control col-md-3" name="email" placeholder="Email" value='<?php if (!empty($row['Email'])) echo $row['Email']; ?>' readonly>
            </div>
            <?php


            // $query = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";;
            // $con = new mysqli(SEVERNAME, USERNAME, PASSWORD, DATABASE, PORT);
            // if ($result = mysqli_query($con, $query)) {

            //   $row = mysqli_fetch_assoc($result);

            //   echo "<div class='info'><strong>Username:</strong> <span>" . $row['UserName'] . "</span></div>";
            //   echo "<div class='info'><strong>Full Name:</strong> <span>" . $row['FullName'] . "</span></div>";
            //   echo "<div class='info'><strong>Email:</strong> <span>" . $row['Email'] . "</span></div>";

            //   //   $query_date = "SELECT DATE_FORMAT(date_joined, '%m/%d/%Y') FROM students WHERE id = '".$_SESSION['userid']."'";
            //   //   $result = mysqli_query($conn, $query_date);

            //   //   $row = mysqli_fetch_row($result);

            //   //   echo "<div class='info'><strong>Date Joined:</strong> <span>".$row[0]."</span></div>";

            // } else {

            //   die("Error with the query in the database");
            // }

            ?><div class="options">
              <a class="btn btn-primary" href="editprofile.php">Edit Profile</a>
              <a class="btn btn-success" href="changepassword.php">Change Password</a>
            </div>
        </div>
        <div class="col-md-3"></div>
      </div>




    </div>

  </section>


  <script src="assets/js/jquery-3.1.1.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>

<?php


//   } else {
//     header("location:index.php");
//     exit;
//   }

unset($_SESSION['prompt']);
mysqli_close($con);
include_once("view/footer.php");
?>