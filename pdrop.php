<html>
<head>
<link rel=stylesheet href="body.css" type="text/css">
</head>
<body>
<?php
	$con=mysqli_connect("localhost","root","","dth");
	if(!$con)
			die("error ".mysqli_connect_error());
			session_start();
					$formData = $_SESSION['formData'];
					$s= $formData['sub'];
					$s1="select * from login where sub_id = $s";
					$res=mysqli_query($con,$s1);
		$row=mysqli_fetch_array($res);

		$t=0;
		foreach ($_POST['pack'] as $selected)
		{
				$s2="select price from p_sub where pk_id=".$selected." and subid = $s";
				$res2=mysqli_query($con,$s2);
				$r2=mysqli_fetch_array($res2);
				$t=$t+$r2['price'];
				$s3="delete from p_sub where pk_id=".$selected." and subid = $s";
				$res3=mysqli_query($con,$s3);
		}
		$t=$t*1.18;
		$s4="select amt_t from balance where sub_id = $s";
		$res4=mysqli_query($con,$s4);
		$r4=mysqli_fetch_array($res4);
		$res=$r4['amt_t'];
?>
<center>
	<table border="2">
	<tr>
	<th>Billed earlier</th>
	<td><?php echo $r4['amt_t']; ?></td></tr><tr>
	<th>Deleted package price</th>
	<td><?php echo "$t"; ?></td></tr>
	<tr>
	<th>Billed now</th>
	<?php
		$res=$res-$t;
		$s5="update balance set amt_t = $res where sub_id = $s";
		$res5=mysqli_query($con,$s5);
	?>
	<td><?php echo "$res"; ?></td></tr>
	</table><br><br>
		package successfully dropped!
		<br>
		<form action="usrpg2.php">
		<input type="submit" value="back to main page"></input>
		</form>
</center></body>
</html>