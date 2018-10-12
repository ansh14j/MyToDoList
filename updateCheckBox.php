<!DOCTYPE html>
<html>
<body>

<?php
// Start the session
session_start();
?>

<?php
$q = intval($_GET['q']);
$l = $_GET['l'];
$i = $_GET['i'];
//$u = intval($_GET['u']);
$u = intval($_SESSION['loginUserID']);
            

$con = mysqli_connect('localhost','ansh','mypassword','mykeep5');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//$sql="UPDATE itemsList SET isChecked = '.$q.' WHERE itemName = '.$i.' AND listName = '.$l.'";
// doubt don't know why above is not working
$sql="UPDATE itemsList SET isChecked = ".$q." WHERE itemName = '".$i."' AND listName = '".$l."' AND userID = '".$u."'";

$result = mysqli_query($con,$sql);

mysqli_close($con);
?>
</body>
</html>