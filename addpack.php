<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<style>
table {
            width: 100%;
        }
 th {
            padding: 10px;
        }
div{
            border: 4px solid black;
      }
input[type="password"], input[type="text"] {
            box-sizing: border-box;
            padding: 5px;
            width: 100%;

        }
</style>
</head>
<body>
<form action="pay_success1.php" method="post">
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


		if ($_SERVER["REQUEST_METHOD"] == "POST") {

		    if (isset($_POST['val'])) {
		        $selected_val = $_POST['val'];
		         $selected_option = '';


				switch ($selected_val) {
					case 'monthly':
						$selected_option = $_POST['g1'];
						break;
					case 'quarterly':
						$selected_option = $_POST['g2'];
						$sn="UPDATE p_sub
						JOIN packages ON packages.pk_id = p_sub.pk_id
						SET p_sub.price = packages.quarterly
						WHERE p_sub.subid = $s
						AND p_sub.status = 'pending'";
						$resn=mysqli_query($con,$sn);
						break;
					case 'anually':
						$selected_option = $_POST['g3'];
						$sn="UPDATE p_sub
						JOIN packages ON packages.pk_id = p_sub.pk_id
						SET p_sub.price = packages.anually
						WHERE p_sub.subid = $s
						AND p_sub.status = 'pending'";
					$resn=mysqli_query($con,$sn);
						break;
        		}

        		$q="select * from recharge";
        		$r=mysqli_query($con,$q);
        		$n=mysqli_num_rows($r)+1;
        		$s2="insert into recharge (sn,sub_id,paid,mode,date) values (".$n.",".$s.",".$selected_option.", '". $selected_val."',
        		curdate())";
				echo "<input type='hidden' name='sno' value='$n'>";

				$res2=mysqli_query($con,$s2);

				switch ($selected_val) {
						case 'monthly':
							$s4="update recharge set due = DATE_ADD(curdate(), INTERVAL 1 MONTH) where sn=".$n;
							$res4=mysqli_query($con,$s4);
							break;
						case 'quarterly':
							$s4="update recharge set due = DATE_ADD(curdate(), INTERVAL 4 MONTH) where sn=".$n;
							$res4=mysqli_query($con,$s4);
							break;
						case 'anually':
							$s4="update recharge set due = DATE_ADD(curdate(), INTERVAL 1 YEAR) where sn=".$n;
							$res4=mysqli_query($con,$s4);
							break;
        		}
		    } else {
		        echo "No option selected.";
		    }
		} else {
		    echo "Form was not submitted.";
		}
?>
<center>
<div class="form-container">

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
 </tr></table>
 <br><br>
Billed <?php echo $selected_val.":         ".$selected_option; ?>
<br><br>
<input type="submit" value="Pay"></input>
<?php
				echo "<input type='hidden' name='pay' value='$selected_option'>";
?>
</form></div></body>
</html>