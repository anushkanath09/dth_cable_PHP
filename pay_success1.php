<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<style>
     div{ border: 4px solid black;}
</style>
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

			$s2="update recharge set time = now() where  sn=".$_POST['sno'];
			$res2=mysqli_query($con,$s2);

			$s7="select * from balance where sub_id= $s";
						if ($res7=mysqli_query($con,$s7))
						{
								if(mysqli_num_rows($res7)>0)
								{
										$s6="update balance set amt_t=amt_t + ".$_POST['pay']." where sub_id=$s";
										$res6=mysqli_query($con,$s6);
								}
								else
								{
										$s8="insert into balance(sub_id,amt_t) values($s,".$_POST['pay'].")";
										$res8=mysqli_query($con,$s8);
								}
						 }

			$s3="update p_sub set status='paid' where subid = ".$s;
			$res3=mysqli_query($con,$s3);
?>
<?php
				$s4="select date,due from recharge where sn=".$_POST['sno'];
				$res4=mysqli_query($con,$s4);
				$r4=mysqli_fetch_array($res4);
?>
<br><br><br>
<div class="form-container">
<table>
<td width="200"><b>Recharged on</b></td>
<td width="200"><b>Due on</b></td>
<tr>
<td width="200"><?php echo $r4['date']; ?></td>
<td width="200"><?php echo $r4['due']; ?></td
</tr>
</table>
</div>
<br>
<form action="usrpg2.php">
<input type="submit" value="back to main page"></input>
</form>
</center>
</body>
</html>