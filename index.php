<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">

<script>
	function login(str) {
        xmlhttp = new XMLHttpRequest();
        //console.log(userID);
        //get DOM data and send to server php side
        var x = document.getElementById(str).elements[0].value
        var y = document.getElementById(str).elements[1].value
		var url = "login.php?uN1=".concat(x).concat("&uP1=").concat(y));
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();
    }	
</script>

</head>
<body>
<h1>Login Page</h2>
<h2>Enter User Name and Password</h2>
	<form action="keep.php" method="POST" id="demo1">
	   <input type="text" name="userName1" required="required"/>
	   <input type="text" name="userPassword1" required="required"/>
       <input class="button" type="submit" value="login" onclick="login("demo1")" />
	   Eg.: testUser, testPassword	
	</form>

<h1>SignUp Page</h2>
<h2>Enter User Name and Password</h2>
	<form action="signup.php" method="POST" id="demo2">
	   <input type="text" name="userName2" required="required"/>
	   <input type="text" name="userPassword2" required="required"/>
       <input class="button" type="submit" value="ADD User" onclick="login("demo2")"/>
	</form>


</body>

</html>

