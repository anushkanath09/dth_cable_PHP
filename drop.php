<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<script>
        function validateCheckboxes() {
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
        function goto(s) {window.location.href=s;}
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
					$row=mysqli_fetch_array($res);
		$s1="SELECT * FROM packages,p_sub where p_sub.pk_id=packages.pk_id and p_sub.subid = $s";
		if ($res=mysqli_query($con,$s1))
				{
						$data=array();
						if(mysqli_num_rows($res)>0)
						{
								while($row=$res->fetch_assoc())
									$data[]=$row;
						}
				}
		?>
<form  action="pdrop.php" method="post">
<br><center>
        <?php
        $i=1;
        foreach ($data as $row):
        ?>
		<div class="form-container">
     	<input type='checkbox' name='pack[]' value="<?php echo $row['pk_id']; ?>" onchange=validateCheckboxes()>
     	<?php echo $row['pk_nm'];
            echo "<br><a href='p$i.php'>view details</a>" ;
            $i=$i+1;
            ?>
            </div><br><br>
       		<?php endforeach;
       		?>
    <br><br><input type="submit" value="Submit" id='submitBtn' disabled></input>
</center></form></body>
</html>
