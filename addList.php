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

    //     //For first run Create table of lists
    // $sql4 = "CREATE TABLE users(ID INT AUTO_INCREMENT NOT NULL, 
    //                                 userName VARCHAR(255), 
    //                                 userPassword VARCHAR(255), 
    //                                 PRIMARY KEY (ID))";
    // $retval = mysqli_query($conn, $sql4);
    // echo 'adding table of users</p>';
    // if(!$retval){
    //  die('Could not create list of users: ' . mysqli_error()); 
    // }
    // // For first run Create list of items
    // $sql5 = "CREATE TABLE lists(ID INT AUTO_INCREMENT NOT NULL, 
    //                                 listName VARCHAR(255), 
    //                                 userID INT, 
    //                                 PRIMARY KEY (ID), 
    //                                 FOREIGN KEY (userID) REFERENCES users(ID))";
    // $retval = mysqli_query($conn, $sql5);
    // echo 'adding table of lists</p>';
    // if(!$retval){
    //  die('Could not create list of lists: ' . mysqli_error()); 
    // }
    // // For first run Create list of users
    // $sql6 = "CREATE TABLE items(ID INT AUTO_INCREMENT, 
    //                                   itemName VARCHAR(255),
    //                                   isChecked INT,
    //                                   listName VARCHAR(255),
    //                                   userID INT,
    //                                   listID INT, 
    //                                   PRIMARY KEY (ID),
    //                                   FOREIGN KEY (listID) REFERENCES lists(ID),
    //                                   FOREIGN KEY (userID) REFERENCES users(ID))";
    // $retval = mysqli_query($conn, $sql6);
    // if(!$retval){
    //  die('Could not create items table: ' . mysqli_error()); 
    // }
	            
?>
