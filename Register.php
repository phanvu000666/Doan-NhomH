<?php
	require_once("model/config.php");

	$error = "TẠO TÀI KHOẢN ĐỂ THAM GIA CÙNG CHÚNG TÔI !";
	if (isset($_POST["btn_submit"])) {
		//lấy thông tin từ các form bằng phương thức POST
		$username = $_POST["username"];
        $fullname = $_POST["fullname"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		//Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
		if ($username == "" || $password == "" || $fullname == "" || $email == "") {
			$error = "Bạn vui lòng nhập đầy đủ thông tin";
		}else{
			// Kiểm tra username hoặc email có bị trùng hay không
				$sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
				$result = mysqli_query($conn, $sql);

				// Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
				if (mysqli_num_rows($result) > 0)
				{
				echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="register.php";</script>';
				// Dừng chương trình
				die ();
				}
				else {
				$sql = "INSERT INTO users (username,fullname, password, email) VALUES ('$username','$fullname','$password','$email')";
				echo '<script language="javascript">alert("Sign up successfully!"); window.location="login.php";</script>';

				if (mysqli_query($conn, $sql)){
				echo "Tên đăng nhập: ".$_POST['username']."<br/>";
				echo "Họ và tên: ".$_POST['fullname']."<br/>";
				echo "Mật khẩu: " .$_POST['password']."<br/>";
				echo "Email đăng nhập: ".$_POST['email']."<br/>";
				}
				else {
				echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="register.php";</script>';
				}
			}	
		}
	}
?>
<html>
<head>
      <title>Register Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         td {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
      </style>
      
</head>
<body bgcolor = "#FFFFFF">
<div align = "center">
	   <div style = "width:300px; border: solid 1px #333333; " align = "left">
		  <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>
		  <div style = "margin:30px">
			 
		  <form method="POST" action="Register.php">
				<table>
			<tr>
				<td>Username :</td>
				<td><input type="text" id="username" name="username"></td>
			</tr>
            <tr>
				<td>Fullname :</td>
				<td><input type="text" id="fullname" name="fullname"></td>
			</tr>
            <tr>
				<td>Email :</td>
				<td><input type="text" id="email" name="email"></td>
			</tr>
			<tr>
				<td>Password :</td>
				<td><input type="password" id="password" name="password"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" name="btn_submit" value="Đăng Ký"></td>
			</tr>
		</table>
			 </form>
			 <a href="Login.php">Login In?</a>
			 <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
		  </div>
			  
	   </div>
		  
	</div>
</body>
</html>