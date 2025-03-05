<html>
<head>
<link rel=stylesheet href="form.css" type="text/css">
<link rel=stylesheet href="body.css" type="text/css">
<style>
        .fixed-size-button {
            width: 200px;
            height: 60px;
        }
        body{
				margin : 60px;
			    }
	    div{
				border: 4px solid black;
			  	}
</style>
<script>
 function goto(s)
		{
			window.location.href=s;
		}
</script></head>
<body>

<center>
<div class="form-container">
<button type="submit" class="form-container fixed-size-button" onClick=goto("ppackage.php")>add package</button><br><br>
<button type="submit" class="form-container fixed-size-button" onClick=goto("drop.php")>drop package</button><br><br>
<button type="submit" class="form-container fixed-size-button" onClick=goto("modp.php")>modify existing package
<br>(Add/Drop channels)</button>
</div>
</center>
</body>
</html>