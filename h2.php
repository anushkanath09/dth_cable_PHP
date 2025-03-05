<html>
<head>
<link rel=stylesheet href="body.css" type="text/css">
<style>  body{
			     margin : 60px;
			     } </style>
<script>
function goto(s)
{
	window.top.location.href=s;
}
</script>
</head>
<body>
<center>
<h3>Already a user?<br><br>
<input type="button" value="Login" onClick=goto("login.php")>
<br><br>
New User?<br><br>
<input type="button" value="Register with us!"
onClick=goto("register.php")></h3>
</div>
</body>
</html>