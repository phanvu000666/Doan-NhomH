<?php
session_start();
?>
<html>
<head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
</head>
<body bgcolor = "#FFFFFF">
<?php
	//Gọi file connection.php ở bài trước
	require_once("model/config.php");
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	$error = "ĐĂNG NHẬP !";
	if (isset($_POST["btn_submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			$error = "Username hoặc Password bạn không được để trống!";
		}else{
			$sql = "select * from users where username = '$username' and password = '$password' ";
			$query = mysqli_query($conn,$sql);
			
			$num_rows = mysqli_num_rows($query);
			$row = $query->fetch_assoc();
			if ($num_rows==0) {
				$error = "Tên đăng nhập hoặc mật khẩu không đúng !";
			}else{
				//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
				$_SESSION['username'] = $username;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                echo '<script language="javascript">alert("Logged in successfully!"); window.location="index.php";</script>';
			}
		}
	}
?>
	
	<div align = "center">
	   <div style = "width:300px; border: solid 1px #333333; " align = "left">
		  <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
		  <div style = "margin:30px">
			 
		  <form method="POST" action="login.php">
				<label>UserName  </label><input type = "text" name = "username" class = "box"/><br /><br />
				<label>Password  </label><input type = "password" name = "password" class = "box" /><br/><br />
				<input name="btn_submit" type = "submit" value = " Đăng nhập "/><br />
			 </form>
			 <a href="register.php">Sign Up?</a>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		  </div>
			  
	   </div>
		  
	</div>
</body>
</html>