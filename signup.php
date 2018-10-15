<?php
// Start the session
session_start();
?>


<?php
//ADD user
//connect to mysql database
$conn = mysqli_connect('localhost','ansh','mypassword','mykeep5');
if(! $conn ) {
      die('Could not connect: ' . mysqli_connect_error());
   }
echo 'Connected successfully</p>';

if (isset($_POST['userPassword2'])) {
    $currentUserName = $_POST['userName2'];
    $currentUserPassword = $_POST['userPassword2'];   
    echo $currentUserName.$currentUserPassword;
    $sql9 = "INSERT INTO users(username, userPassword) VALUES('$currentUserName','$currentUserPassword')";
    $retval9 = mysqli_query( $conn, $sql9 );
    if(! $retval9 ) {
    echo('Could not add user' . mysqli_error());
    }
}
?>

<html>
<body>
<h1>Signed up</h2>
	<form action="index.php" method="POST">
       <input class="button" type="submit" value="click to ddlogin"/>
	</form>
</body>
</html>