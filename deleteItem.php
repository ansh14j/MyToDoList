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
           //echo $_GET['i'];           
        if (isset($_GET['i'])) {
    		$currentListID = $_GET['l'];
			//$currentUserID = intval($_GET['u']);
			$currentUserID = intval($_SESSION['loginUserID']);
		    $newItemID = $_GET['i'];
    		$sql = "DELETE FROM itemsList WHERE itemID = '$newItemID' AND listID = '$currentListID' AND userID = '$currentUserID'";
	    	$retval = mysqli_query($conn, $sql);
            echo "$sql";
	    	if(!$retval){
                echo "asdf2";
		    	die('Could not delete data: ' . mysqli_error());	
            }
        }
	            
?>
