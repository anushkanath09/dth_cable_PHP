<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
</head>
<body>
<center>
<div class="form-container" color="green">
<img src="tick.png" width="20" height="20">Payment successful</div>
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

			$s2="update recharge set time = now() where sub_id = ".$s;
			$res2=mysqli_query($con,$s2);

			$s3="update p_sub set status='paid' where subid=".$s;
			$res3=mysqli_query($con,$s3);

			$s4="select date,due from recharge where sub_id =".$s;
			$res4=mysqli_query($con,$s4);
			$r2=mysqli_fetch_array($res4);

			$t=0;
			$s5="select * from recharge where  sub_id= $s";
			if ($res5=mysqli_query($con,$s5))
			{
					if(mysqli_num_rows($res5)>0)
					{
							while($row=mysqli_fetch_array($res5)
										$t=$t+$row['paid'];

					}
			}

			$s7="select * from balance where sub_id= $s";
			if ($res7=mysqli_query($con,$s7))
			{
					if(mysqli_num_rows($res7)>0)
					{
							$s6="update balance set amt_t=$t where sub_id=$s";
							$res6=mysqli_query($con,$s6);
					}
					else
					{
							$s8="insert into balance(sub_id,amt_t) values($s,$t)";
							$res8=mysqli_query($con,$s8);
					}
			}
?>
<br><br><br>
<div class="form-container">
<table>
<td width="200"><b>Recharged on</b></td>
<td width="200"><b>Due on</b></td>
<tr>
<td width="200"><?php echo $r2['date']; ?></td>
<td width="200"><?php echo $r2['due']; ?></td
</tr>
</table>
</div>
</center>
</body>
</html>
