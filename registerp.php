<html>
<head></head>
<body>
<?php
			$con=mysqli_connect("localhost","root","","dth");
			if(!$con)
				die("error ".mysqli_connect_error());
			$f=$_POST['f1'];
			$l=$_POST['l1'];
			$m=$_POST['m1'];
			$e=$_POST['e1'];
			$sql="select * from login";
			if($res=mysqli_query($con,$sql))
			{
				$n=mysqli_num_rows($res);

				$s=1100+$n;
				$sql1="insert into login(sub_id,f_name,l_name,mob_no,email_id) values ( '".$s."','".$f."' , '".$l."' , '".$m."' , '".$e."')";
							if($res=mysqli_query($con,$sql1))
							{
									echo "<center><form class='form-container'><font color='green'>registration successful</font>";
									echo "your subscriber id is <b>".$s."</b> use it for future references..</center></form>";
									include("login.php");
							}
							else
								echo "failed".mysqli_error($con);
			}
			else
				echo "failed".mysqli_error($con);


			mysqli_close($con);
?>

</html>