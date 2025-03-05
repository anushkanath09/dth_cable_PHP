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
		$gst=0;
?>
		<center>
		<form action="payp.php" method="post">
		<table border="2">
		<tr>
		<th>Selected channel(s)</th>
		<th></th>
		<th>Monthly price</th>
		</tr>
<?php
			foreach ($_POST['channel'] as $selected)
			{
					$s3="select truncate($selected/1000,0) 'res' from dual";
					$res3=mysqli_query($con,$s3);
					$row3=mysqli_fetch_array($res3);
					switch ($row3['res'])
					{
							case 1:
									$s2="select * from bangla where chid = ".$selected;
									$res2=mysqli_query($con,$s2);
									$row2=mysqli_fetch_array($res2);
									$s4="insert into p_sub values(".$s.",'".$row['f_name']."',".$selected.",".$row2['price'].",'pending')";
									$res4=mysqli_query($con,$s4);
									echo "<tr>";
									echo "<td><center>".$row2['chnm']."</center></td>";
									echo "<td><img src='data:image/jpeg;base64," . base64_encode($row2['pic']) . "' alt='Channel Image'
									width='100' height='100'></td>";
									echo "<td><center>".$row2['price']."</center></td>";
									$t=$t+$row2['price'];
									echo "</tr>";
									break;
							case 2:
									$s2="select * from hindi where chid = ".$selected;
									$res2=mysqli_query($con,$s2);
									$row2=mysqli_fetch_array($res2);
									$s4="insert into p_sub values(".$s.",'".$row['f_name']."',".$selected.",".$row2['price'].",'pending')";
									$res4=mysqli_query($con,$s4);
									echo "<tr>";
									echo "<td><center>".$row2['chnm']."</center></td>";
									echo "<td><img src='data:image/jpeg;base64," . base64_encode($row2['pic']) . "' alt='Channel Image'
									width='100' height='100'></td>";
									echo "<td><center>".$row2['price']."</center></td>";
									$t=$t+$row2['price'];
									echo "</tr>";
									break;
							case 3:
									$s2="select * from kids where chid = ".$selected;
									$res2=mysqli_query($con,$s2);
									$row2=mysqli_fetch_array($res2);
									$s4="insert into p_sub values(".$s.",'".$row['f_name']."',".$selected.",".$row2['price'].",'pending')";
									$res4=mysqli_query($con,$s4);
									echo "<tr>";
									echo "<td><center>".$row2['chnm']."</center></td>";
									echo "<td><img src='data:image/jpeg;base64," . base64_encode($row2['pic']) . "' alt='Channel Image'
									width='100' height='100'></td>";
									echo "<td><center>".$row2['price']."</center></td>";
									$t=$t+$row2['price'];
									echo "</tr>";
									break;
						}
					}
					$gst=0.18*$t;
					echo "<tr>";
					echo"<th colspan='2'>Total</th>";
					echo"<td><center>".$t."</center></td>";
					echo "<tr>";
					echo"<th colspan='2'>18% GST</th>";
					echo"<td><center>".$gst."</center></td>";
					echo"</tr>";
					echo"<tr>";
					echo"<th colspan='2'>Total payable</th>";
					$t=1.18*$t;
					echo "<input type='hidden' name='total' value='$t'>";
					echo"<td><center>".$t."</center></td></tr>";
?>
</table><br><br>
<input type="submit" value="Continue with payment>>"></input>
</form></center></body>
</html>