<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<style>
table { width: 100%;}
th { padding: 10px;}
input[type="password"], input[type="text"] {
            box-sizing: border-box;
            padding: 5px;
            width: 100%; }
</style></head>
<body><center>
<div class="form-container">
 <form action="pay_success1.php" method="post">
 <th> Card Holder's Name</th></br>
 <td><input type="text" name="cnm" required></td><br><br>
 <table>
 <th>Card no </th>
 <th>Expiration Date</th>
 <th>CVV</th>
 <tr>
 <td><input type="password" name="cno" maxlength="10" required></td>
 <td><input type="text" name="ed" placeholder="MM/YY" required></td>
 <td><input type="password" name="cvv" maxlength="3" required></td>
 </tr></table><br><br>
<th colspan="2">Billed <?php echo $_POST['total']; ?>
<br><br>
<input type="submit" value="Pay"></input>
</div>
<?php
			$con=mysqli_connect("localhost","root","","dth");
			if(!$con)
					die("error ".mysqli_connect_error());
			session_start();
					$formData = $_SESSION['formData'];
					$s= $formData['sub'];
					$s1="select * from login where sub_id = $s";
					$res=mysqli_query($con,$s1);
			$q="select * from recharge";
			$r=mysqli_query($con,$q);
			$n=mysqli_num_rows($r)+1;
			$s2="insert into recharge(sn,sub_id,paid,mode,date,due) values (".$n.",".$s.",".$_POST['total'].", 'monthly',
			curdate(),DATE_ADD(curdate(), INTERVAL 1 MONTH))";
			$res2=mysqli_query($con,$s2);
			echo "<input type='hidden' name='sno' value='$n'>";
			echo "<input type='hidden' name='pay' value='".$_POST['total']."'></form>";
?></body></html>