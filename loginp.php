<html>
<head>
</head>
<body>
<?php
		$con=mysqli_connect("localhost","root","","dth");
		if(!$con)
		die("error ".mysqli_connect_error());
		$s=$_POST['sub'];
		$sql="select * from login where sub_id = $s";

		if ($res=mysqli_query($con,$sql))
		{
				if(mysqli_num_rows($res)>0)
				{
					session_start();
					$_SESSION['formData'] = $_POST;
					header("Location: usrpg.php");
					exit;

				}
				else
				{
					include("login.php");
					echo "<form class='form-container'><font color='red'>username or password is wrong..</font></form>";
				}
		}
		mysqli_close($con);
?>
</body>
</html>