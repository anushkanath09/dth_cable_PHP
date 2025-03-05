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


		$sql="select * from login where sub_id = $s";
		$res=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($res);
		echo "<center><form class='form-container'><font color='green'><h2>welcome ".$row['f_name']." ".$row['l_name'];
		echo "<br>subscriber id: ".$s."</h2></font></form></center>";
		exit;
?>


</body>
</html>