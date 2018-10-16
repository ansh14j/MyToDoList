<?php
// Start the session
session_start();
?>

<?php
		//connect to mysql database
		$conn = mysqli_connect('localhost','ansh','mypassword','mykeep5');
		if(! $conn ) {
      		die('Could not connect: ' . mysqli_connect_error());
   		}
           echo 'Connected successfully</p>';

        if (isset($_GET['i'])) {
            $newItem = $_GET['i'];
            $currentListName = $_GET['l'];
            $oldItem = $_GET['o'];
            //$currentUserID = intval($_GET['u']);
            $currentUserID = intval($_SESSION['loginUserID']);
            $sql = "UPDATE itemsList SET itemName = '$newItem' WHERE listName = '$currentListName' AND itemName = '$oldItem' AND userID = '$currentUserID'";
            $retval = mysqli_query($conn, $sql);
            if(!$retval){
                die('Could not set data: ' . mysqli_error());	
            }
        }

?>
