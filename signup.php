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

if (isset($_POST['uP2'])) {
    $currentUserName = $_POST['uN2'];
    $currentUserPassword = $_POST['uP2'];   
    
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
       <input class="button" type="submit" value="click to login"/>
	</form>
</body>
</html>