<html>
<body>
<?php
		$con=mysqli_connect("localhost","root","","dth");
		if(!$con)
		die("error ".mysqli_connect_error());
		$e=$_POST['mail'];
		echo $e;
		$sql="select sub_id from login where email_id ='".$e."'";
		include("login.php");
				if ($res=mysqli_query($con,$sql))
				{
							$row=mysqli_fetch_array($res);
							echo "<form class='form-container'><font color='green'>subscriber id: ".$row['sub_id']."</font></form>";
				}
				else
				{
					echo "<form class='form-container'><font color='red'>no subscriber id matched for the said email!!</font></form>";
				}

				mysqli_close($con);
		?>
		</body>
</html>