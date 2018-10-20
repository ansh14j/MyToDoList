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

        if (isset($_GET['l'])) {
            $currentListID = $_GET['l'];
            $currentUserID = intval($_SESSION['loginUserID']);

            //Getting items from list
            $sql2 = "SELECT itemName, isChecked, itemID FROM itemsList 
                        WHERE listID = '$currentListID' 
                            AND userID = '$currentUserID'";
            $retval = mysqli_query($conn, $sql2);
            if(! $retval ) {
                echo('Could not get data1: ' . mysqli_error());
            }

            $rows = array();
            while($r = mysqli_fetch_assoc($retval)) {
                $rows[] = $r;
            }
            echo json_encode($rows);
        }
?>
