<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<style>
     th { border: 4px solid black;}
</style>
<script>
function goto(s)
		{
			window.location.href=s;
		}
function validateCheckboxes() {
            const r = document.querySelectorAll('input[type="radio"]');
            const submitButton = document.getElementById('submitBtn');
            checked = false;

            r.forEach((radio) => {
                if (radio.checked) {
                    checked = true;
                }
            });
            submitButton.disabled = !checked;
        }
 </script>
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


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST['pack'])) {
			// Display selected options
			echo "<center>";
			echo "<table border='2'>";
			echo "<tr>";
			echo "<th>selected packages</th>";
			echo "<th>monthly</th>";
			echo "<th>quarterly</th>";
			echo "<th>anually</th>";
			echo "</tr>";

			$tm=0;
			$tq=0;
			$ta=0;
			foreach ($_POST['pack'] as $selected) {
				$s2="select * from packages where pk_id=".$selected;
				$res2=mysqli_query($con,$s2);
				$row2=mysqli_fetch_array($res2);

				echo "<tr>";
				echo "<td>".$row2['pk_nm']."</td>";
				echo "<td>".$row2['monthly']."</td>";
				echo "<td>".$row2['quarterly']."</td>";
				echo "<td>".$row2['anually']."</td>";
				echo "</tr>";
				$tm=$tm+$row2['monthly'];
				$tq=$tq+$row2['quarterly'];
				$ta=$ta+$row2['anually'];
			}

			echo "</table>";
			echo "<table border='2'><tr>";
			echo "<th>Total price: </th>";
			echo "<td>".$tm."</td>";
			echo "<td>".$tq."</td>";
			echo "<td>".$ta."</td>";
			echo "</tr></table>";
			echo "<b>GST: 18%</b><br>";
			$g1=1.18*$tm;
			$g2=1.18*$tq;
			$g3=1.18*$ta;
			/*echo "Final price: ".$g1;*/
			echo "<br><br>";

			echo "<form action='addpack.php' method='post' >";
			echo "<table>";
echo "<tr>";
echo "<th class='form-container'>Billing monthly<br><input type='radio' name='val' value='monthly' onchange=
validateCheckboxes()>".$g1."</th>";
echo "<th class='form-container'>Billing quarterly<br><input type='radio' name='val' value='quarterly' onchange=
validateCheckboxes()>".$g2."</th>";
echo "<th class='form-container'>Billing annually<br><input type='radio' name='val' value='anually' onchange=
validateCheckboxes()>".$g3."</th>";
echo "</tr>";
						echo "<input type='hidden' name='g1' value='$g1'>";
						echo "<input type='hidden' name='g2' value='$g2'>";
   						echo "<input type='hidden' name='g3' value='$g3'>";
			echo "</table><br><br><input type='submit' value='Continue to payment' id='submitBtn' disabled></input>
			</form></center>";
			$sql="select * from p_sub";
			if ($res1=mysqli_query($con,$sql))
			{
				/*$n=mysqli_num_rows($res1)+1;*/
				foreach ($_POST['pack'] as $selected)
				{
					$s2="select monthly from packages where pk_id=".$selected;
					$res2=mysqli_query($con,$s2);
					$row2=mysqli_fetch_array($res2);
					$s3="insert into p_sub values(".$row['sub_id'].",'".$row['f_name']."',".$selected.",".$row2['monthly'].",'pending')";
					$res3=mysqli_query($con,$s3);
					/*$n=$n+1;*/
				}
			}
		} else {
			echo "<p>No options selected.</p>";
		}
	}
?></body></html>



