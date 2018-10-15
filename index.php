<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">	

</head>
<body>
<div class="row" style="text-align: center">
	<div class="col-sm-12">
		<div class="card">
			<h2>Login Page</h2>
			<h3>Enter User Name and Password</h3>
				<form action="login.php" method="POST">
				<input type="text" name="userName1" required="required"/>
				<input type="password" name="userPassword1" required="required"/>
				<input class="button" type="submit" value="login" /></br>
				Eg.: testUser, testPassword	
				</form>
		</div>
	</div>

	<div class="col-sm-12">
		<div class="card">
			<h2>SignUp Page</h2>
			<h3>Enter User Name and Password</h3>
				<form action="signup.php" method="POST">
				<input type="text" name="userName2" required="required"/>
				<input type="text" name="userPassword2" required="required"/>
				<input class="button" type="submit" value="ADD User"/>
				</form>
		</div>
	</div>
</div>
				

</body>

</html>

