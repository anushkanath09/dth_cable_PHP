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
</script></head>
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
					$s2="select bangla.* from bangla,p_sub where bangla.chid=p_sub.pk_id and subid=$s union select hindi.* from
					hindi,p_sub where hindi.chid=p_sub.pk_id and subid=$s union select kids.* from kids,p_sub where kids.chid=
					p_sub.pk_id and subid=$s";
					$res2=mysqli_query($con,$s2);

?>
					<center>
					<form action="pdrop.php" method="post">
					<table border="1">
					<tr>
					            <th>Select</th>
					            <th>Channel Name</th>
					            <th></th>
					            <th>Price</th>
					</tr>
					<?php
						while($r2=mysqli_fetch_array($res2))
						{

								            echo "<tr>";
								            echo "<td><center><input type='checkbox' name='pack[]' value='" . htmlspecialchars($r2['chid']) . "'
								            onclick='toggleSubmitButton()'></center></td>";
								            echo "<td><center>" . htmlspecialchars($r2['chnm']) . "</center></td>";
								            echo "<td><img src='data:image/jpeg;base64," . base64_encode($r2['pic']) . "' alt='Channel Image'
								            width='100' height='100'></td>";
								             echo "<td><center>" . htmlspecialchars($r2['price']) . "</center></td>";
								             echo "</tr>";
					      }
					?>
					</table><br>
					<center><br>
					 <input type="submit" value="Submit" id='submitBtn' disabled></input>
					 </form>
					 </center>
					</body></html>

