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

        
           $currentUserID = intval($_SESSION['loginUserID']);
        //echo $currentUserID;

		//Getting list of lists from database
		$sql = "SELECT listName FROM lists WHERE userID = '$currentUserID'";
		$retval = mysqli_query( $conn, $sql );
		if(! $retval ) {
		   die('Could not get listName: ' . mysqli_error());
        }

        $rows = array();
        while($r = mysqli_fetch_assoc($retval)) {
            $rows[] = $r;
        }
        echo json_encode($rows);

        

?>
