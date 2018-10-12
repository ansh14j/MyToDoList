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
        //   echo 'Connected successfully</p>';

        if (isset($_GET['l'])) {
            $currentListName = $_GET['l'];
            $currentUserID = intval($_SESSION['loginUserID']);
            //echo $currentUserID;

            //Getting items from list
            $sql2 = "SELECT isChecked FROM itemsList 
                        WHERE listName = '$currentListName' 
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
