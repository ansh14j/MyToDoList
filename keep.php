<!-- USING HTML AND PHP AND JS-->
<!-- Next step is trying to get data from server using AJAX and update in DOM element
	 But this is difficult to achieve without full control over DOM elements ie with php
	 So use javascript framework to achieve that -->

<?php
// Start the session
session_start();
?>

<?php
function addItem($conn){
	if (isset($_POST['newItemName'])) {
		$newItem = $_POST['newItemName'];
		$currentListName = $_POST['listName2'];
		$currentUserID = intval($_POST['userID2']);
		$sql = "INSERT INTO itemsList(itemName,listName,isChecked,userID) 
					VALUES ('$newItem','$currentListName',false,'$currentUserID')";
		$retval = mysqli_query($conn, $sql);
		if(!$retval){
			die('Could not set data: ' . mysqli_error());	
		}
	}
}

// function deleteItem($conn){
// 	if (isset($_POST['trashItemName'])) 
// 	{
// 		$currentListName = $_POST['listName1'];
// 		$currentUserID = intval($_POST['userID1']);
// 		$newItem = $_POST['trashItemName'];
// 		$sql = "DELETE FROM itemsList 
// 					WHERE itemName = '$newItem' 
// 						AND listName = '$currentListName' 
// 							AND userID = '$currentUserID'";
// 		$retval = mysqli_query($conn, $sql);

// 		if(!$retval){
// 			die('Could not delete data: ' . mysqli_error());	
// 		}
// 	}
// }

function deleteList($conn){
	//deleting List from database
	if (isset($_POST['trashListName'])){
		$currentListName = $_POST['trashListName'];
		$currentUserID = intval($_POST['userID3']);
		//$sql = "DROP TABLE $currentListName";
		$sql = "DELETE FROM itemsList 
					WHERE listName = '$currentListName' 
						AND userID = '$currentUserID'";
		$retval = mysqli_query($conn, $sql);
		if(!$retval){
			die('Could not delete list: ' . mysqli_error());	
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
}

function addList($conn){
	//adding listName in lists of database
	if (isset($_POST['newListName'])) {
		$newList = $_POST['newListName'];
		$currentUserID = intval($_POST['userID4']);
		$sql = "INSERT INTO lists(listName,userID) 
						VALUES ('$newList','$currentUserID')";
		$retval = mysqli_query($conn, $sql);
		if(!$retval){
			die('Could not add listName: ' . mysqli_error());	
		}
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>myKeep</title>
	<link rel="stylesheet" type="text/css" href="mystyle.css">

	<script>
	function updateCheckBox(checkBoxIndex,list,item,userID) {
        xmlhttp = new XMLHttpRequest();
        console.log(userID);
        //get DOM data and send to server php side
        var checkBox = document.getElementById(checkBoxIndex);
        if (checkBox.checked == true){
        		var url = "updateCheckBox.php?q=1&l=".concat(list)
											.concat("&i=").concat(item)
												.concat("&u=").concat(userID);
            xmlhttp.open("GET",url,true);
	        xmlhttp.send();
        } else {
        		var url = "updateCheckBox.php?q=0&l=".concat(list)
											.concat("&i=").concat(item)
												.concat("&u=").concat(userID);
           	xmlhttp.open("GET",url,true);
    		xmlhttp.send();
        }
    }

	function deleteItem(str) {
        xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
			//update DOM element without using recieved data
			document.getElementById(str).elements[5].outerHTML = null;
			document.getElementById(str).elements[4].outerHTML = null;
			document.getElementById(str).elements[3].outerHTML = null;
    		}
  		};
        //console.log(userID);
        //get DOM data and send to server php side
        var l = document.getElementById(str).elements[0].value
        var u = document.getElementById(str).elements[1].value
		var i = document.getElementById(str).elements[2].value
		var url = "deleteItem.php?l=".concat(l)
							.concat("&u=").concat(u)
								.concat("&i=").concat(i);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();

    }	
	</script>
</head>

<body>
	<?php
		//connect to mysql database
		$dbhost = 'localhost';
		$dbuser = 'ansh';
		$dbpass = 'mypassword';
		$dbname = 'mykeep5';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		if(! $conn ) {
      		die('Could not connect: ' . mysqli_connect_error());
   		}
	   	echo 'Connected successfully</p>';

		addItem($conn);
		//deleteItem($conn);
		deleteList($conn);
		addList($conn);

		// //For first run Create table of lists
		// $sql4 = "CREATE TABLE users(userID INT AUTO_INCREMENT NOT NULL, userName VARCHAR(255), userPassword VARCHAR(255), PRIMARY KEY (userID))";
		// $retval = mysqli_query($conn, $sql4);
		// echo 'adding table of users</p>';
		// if(!$retval){
		// 	die('Could not create list of users: ' . mysqli_error());	
		// }
		// // For first run Create list of items
		// $sql5 = "CREATE TABLE lists(listID INT AUTO_INCREMENT NOT NULL, listName VARCHAR(255), userID VARCHAR(255), PRIMARY KEY (listID))";
		// $retval = mysqli_query($conn, $sql5);
		// echo 'adding table of lists</p>';
		// if(!$retval){
		// 	die('Could not create list of lists: ' . mysqli_error());	
		// }
		// // For first run Create list of users
		// $sql6 = "CREATE TABLE itemsList(itemID INT AUTO_INCREMENT,itemName VARCHAR(255),isChecked INT,listName VARCHAR(255),userID VARCHAR(255), PRIMARY KEY (itemID))";
		// $retval = mysqli_query($conn, $sql6);
		// if(!$retval){
		// 	die('Could not create items table: ' . mysqli_error());	
		// }

		//print_r($_SESSION);   
		$currentUserID = intval($_SESSION['loginUserID']);
        //echo $currentUserID;

		//Getting list of lists from database
		$sql = "SELECT listName FROM lists WHERE userID = '$currentUserID'";
		$retval = mysqli_query( $conn, $sql );
		if(! $retval ) {
		   die('Could not get listName: ' . mysqli_error());
		}
		
		// index for checkbox using listName		
		$index1 = 0;
		while($rowLists = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
			//show list names on the page
		   ?>
		   <h4><span> <?php echo "{$rowLists['listName']} <br> ";?></span></h4>
		   <?php
		   $index1 = $index1 + 1;

		   $currentListName = $rowLists['listName'];
		   //Getting items from list
		   $sql2 = "SELECT itemName FROM itemsList 
		   				WHERE listName = '$currentListName' 
						   AND userID = '$currentUserID'";
		   $retval2 = mysqli_query($conn, $sql2);
		   if(! $retval2 ) {
		      echo('Could not get data1: ' . mysqli_error());
		   }

		   //Getting checked status from list
		   $sql3 = "SELECT isChecked FROM itemsList 
		   				WHERE listName =  '$currentListName' 
							AND userID = '$currentUserID'";
		   $retval3 = mysqli_query($conn, $sql3);
		   if(! $retval3 ) {
		      echo('Could not get data2: ' . mysqli_error());
		   }
		   	// index for checkbox using itemName
		    $index2 = 0;
			while($rowItems = mysqli_fetch_array($retval2, MYSQLI_ASSOC) 
				and $rowChecked = mysqli_fetch_array($retval3, MYSQLI_ASSOC) ) {
		      	$index2 = $index2 + 1;

		      	//setting variable to use in html dom
		      	if($rowChecked['isChecked']==1)
		      		$IsChecked = checked;
		      	else
		      		$IsChecked = unchecked;
		      	?>
		      	<!-- html form to delete item -->

		      	<form action="" 
				  		class="demo10" 
				  			id="formId<?php echo $index1 ?>_<?php echo $index2 ?>">
		        	<input type="hidden" 
								name="listName1" 
									value = "<?php echo $rowLists['listName']?>" 
										required="required" />
		        	<input type="hidden" 
								name="userID1" 
									value = "<?php echo $currentUserID?>" 
										required="required" />
		        	<input type="hidden" 
								name="trashItemName" 
									value = "<?php echo $rowItems['itemName']?>" 
										required="required" />
		      		<input class="del"
					  			type="button" 
								  	value="x" 
									  	onclick=deleteItem("formId<?php echo $index1 ?>_<?php echo $index2 ?>")>
		      		<!-- form for checkbox for item with respective id, connected to the database-->
		        	<input class="isChecked" 
								type="checkbox" 
									id="myCheck<?php echo $index1 ?>_<?php echo $index2 ?>" 
										value <?php echo $IsChecked ?> 
											onclick="updateCheckBox(this.id, 
																	'<?php echo $rowLists['listName']?>', 
																	'<?php echo $rowItems['itemName']?>', 
																	'<?php echo $currentUserID?>')">
		      		<!-- show list items in the page -->
					<input class="isChecked" 
								value="<?php echo $rowItems['itemName']?>" 
									disabled/>
		      	</form>
		      		</div>

		      	<?php
		    }
		   ?>
		   
		   <!-- html form to add item -->
		   <form action="" 
		   			method="POST" 
					   id="addFormId<?php echo $index1 ?>_<?php echo $index2 ?>">
		      <input type="hidden" 
			  			name="userID2" 
							value = "<?php echo $currentUserID?> " 
								required="required" />
		      <input type="hidden" 
			  			name="listName2" 
							value = "<?php echo $rowLists['listName']?> " 
								required="required" />
		      Add new data: <input type="text" 
			  							name="newItemName" 
									  		required="required" />
		      <input type="submit" 
			  			class="button" 
						  value="Add"/>
		   </form>
		   <!-- html form to delete list -->
		   <form action=""
		   			 method="POST">
		      <input type="hidden" 
			  			name="userID3" 
							value = "<?php echo $currentUserID?> " 
								required="required" />
			  <input type="hidden" 
			  			name="trashListName" 
						  value = "<?php echo $rowLists['listName']?> " 
						  	required="required" />
		      <input type="submit" 
			  			class="button" 
							value="DeleteList"/>
		   </form>

		   <?php
		}
	?>

    <!-- html form to add list -->
	<h2>Add New List</h2>
	<form action="" 
			method="POST">
	   <input type="hidden" 
	   			name="userID4" 
					value = "<?php echo $currentUserID?> " 
						required="required" />
	   Enter new list name: <input type="text" 
	   									name="newListName" 
										   required="required" />
	   <input class="button" 
	   			type="submit" 
				   value="AddList"/>
	</form>

</body>

</html>
