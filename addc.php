<html>
<head>
<link rel=stylesheet href="body.css" type="text/css">
<script>
function toggleSubmitButton(){
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const submitButton = document.getElementById('submitBtn');
            checked = false;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
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


			$s2=" SELECT packages.pk_id, packages.pk_nm
    FROM packages
    LEFT JOIN p_sub ON packages.pk_id = p_sub.pk_id AND p_sub.subid = $s
    WHERE p_sub.pk_id IS NULL";
			$res=mysqli_query($con,$s2);

?>
<center>
<form action="payc.php" method="post">
<table border="1">
<tr>
            <th>Select</th>
            <th>Channel Name</th>
            <th></th>
            <th>Price</th>
</tr>
<?php
	while($row=mysqli_fetch_array($res))
	{
		$s3="select * from ".$row['pk_nm'];
		$res3=mysqli_query($con,$s3);

			while ($r = mysqli_fetch_array($res3)) {
			            echo "<tr>";
			            echo "<td><center><input type='checkbox' name='channel[]' value='" . htmlspecialchars($r['chid']) .
			            "' onclick='toggleSubmitButton()'></center></td>";
			            echo "<td><center>" . htmlspecialchars($r['chnm']) . "</center></td>";
			            echo "<td><center><img src='data:image/jpeg;base64," . base64_encode($r['pic']) .
			            "' alt='Channel Image' width='100' height='100'></center></td>";
			             echo "<td><center>" . htmlspecialchars($r['price']) . "</center></td>";
			             echo "</tr>";
        }
      }
?>
</table>
<br><center><br>
 <input type="submit" value="Submit" id='submitBtn' disabled></input>
 </form></center>
</body>
</html>