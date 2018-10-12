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
           echo 'Connected successfully</p';
           //echo $_GET['i'];           
        if (isset($_GET['l'])) {
    		$currentListName = $_GET['l'];
			//$currentUserID = intval($_GET['u']);
            $currentUserID = intval($_SESSION['loginUserID']);
            //adding listName in lists
		    $sql = "INSERT INTO lists(listName,userID) 
						VALUES ('$currentListName','$currentUserID')";
            $retval = mysqli_query($conn, $sql);
            if(!$retval){
                die('Could not add listName: ' . mysqli_error());	
            }
        }
	            
?>
