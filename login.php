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
           
        if (isset($_POST['userPassword1'])) {
            $currentUserName = $_POST['userName1'];
            $currentUserPassword = $_POST['userPassword1'];   
            // echo $currentUserName;
            // echo $currentUserPassword;  
            $sql0 = "SELECT userID FROM users WHERE userName = '$currentUserName' AND userPassword = '$currentUserPassword'";
            $retval0 = mysqli_query( $conn, $sql0 );
            if(! $retval0 ) {
            echo('Could not get user IDs: ' . mysqli_error());
            }
            while($row0 = mysqli_fetch_array($retval0, MYSQLI_ASSOC)) {
            $currentUserID = intval("{$row0['userID']}<br>");
            }
            //echo $currentUserID."adsfa";

            $_SESSION["loginUserID"] = $currentUserID;

            //echo "Favorite ID is: " . $_SESSION["loginUserID"] . ".<br>";
            //print_r($_SESSION);
            if($currentUserID)
            header('Location: keep.php');
            else
            echo "Incorrect user id or password";
        }        
?>
