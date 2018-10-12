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
            //deleting List from database
		    $sql = "DELETE FROM itemsList 
					WHERE listName = '$currentListName' 
						AND userID = '$currentUserID'";
            $retval = mysqli_query($conn, $sql);
            echo "$sql";
	    	if(!$retval){
                echo "asdf2";
		    	die('Could not delete data: ' . mysqli_error());	
            }
            //deleting listName from list
    		$sql2 = "DELETE FROM lists 
                    WHERE listName = '$currentListName' 
                        AND userID = '$currentUserID'";
            $retval = mysqli_query($conn, $sql2);
            if(!$retval){
            die('Could not remove listName: ' . mysqli_error());	
            }
        }
	            
?>
