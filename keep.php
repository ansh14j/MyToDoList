<!-- USING HTML AND PHP AND JS-->
<!-- Next step is trying to get data from server using AJAX and update in DOM element
	 But this is difficult to achieve without full control over DOM elements ie with php
	 So use javascript framework to achieve that -->

<?php
// Start the session
session_start();
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

	function deleteItem(str,l,u,i) {
        xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
			//update DOM element without using recieved data
			//document.getElementById(str).elements[2].outerHTML = null;
			//document.getElementById(str).elements[1].outerHTML = null;
			//document.getElementById(str).elements[0].outerHTML = null;
			document.getElementById(str).outerHTML = null;
			}
  		};
        //console.log(userID);
        //get DOM data and send to server php side
		var url = "deleteItem.php?l=".concat(l)
							.concat("&u=").concat(u)
								.concat("&i=").concat(i);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();
	}


	function deleteList(str, l){

		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(str).outerHTML = null;
			}
  		};
        //console.log(userID);
        //get DOM data and send to server php side
		var url = "deleteList.php?l=".concat(l);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();	
	}

	function addItem(str,l,u) {
        xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
			//update DOM element without using recieved data
			//location.reload();
			makeli(document.getElementById('list_'.concat(l)),i,l,0);
			document.getElementById(str).outerHTML = null;
			makeInputText(document.getElementById('list_'.concat(l)),l);
			makeDeleteList(document.getElementById('list_'.concat(lName)),lName);
			}
  		};
        //console.log(userID);
        //get DOM data and send to server php side
		var i = document.getElementById(str).elements[0].value;
		var url = "addItem.php?l=".concat(l)
							.concat("&u=").concat(u)
								.concat("&i=").concat(i);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();
	}

	function addList(str) {
        xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
			//update DOM element without using recieved data
			//location.reload();
			makeUL(document.getElementById('demo21'), l);
				makeDeleteList(document.getElementById('list_'.concat(l)),l);
				makeInputText(document.getElementById('list_'.concat(l)),l);
			}
  		};
        //console.log(userID);
        //get DOM data and send to server php side
		var l = document.getElementById(str).elements[0].value;
		var url = "addList.php?l=".concat(l);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();
	}

	function enterAddList(event,str){
		var x = event.key;
			
		if(x==="Enter"){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				//location.reload();
				makeUL(document.getElementById('demo21'), l);
				makeDeleteList(document.getElementById('list_'.concat(l)),l);
				makeInputText(document.getElementById('list_'.concat(l)),l);
				}
			};
			//console.log(userID);
			//get DOM data and send to server php side
			var l = document.getElementById(str).elements[0].value;
		var url = "addList.php?l=".concat(l);
        xmlhttp.open("GET",url,true);
	    xmlhttp.send();
		}
	}

	function enterPressed(event,str,l,u){
		var x = event.key;
		var i = document.getElementById(str).value;
			
		if(x==="Enter"){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				//location.reload();
				//if(document.getElementById('list_'.concat(l)))
					//makeUL(document.getElementById('demo21'),l);
				makeli(document.getElementById('list_'.concat(l)),i,l,0);
				document.getElementById(str).outerHTML = null;
				makeInputText(document.getElementById('list_'.concat(l)),l);
				document.getElementById(str).focus();
				console.log(2);
				}
			};
			//console.log(userID);
			//get DOM data and send to server php side
			//var i = document.getElementById(str).value;
			var url = "addItem.php?l=".concat(l)
								.concat("&u=").concat(u)
									.concat("&i=").concat(i);
			xmlhttp.open("GET",url,true);
			xmlhttp.send();	
		}
	}


	function makeUL(list,arrayitem) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('ul');
			item.id = "list_".concat(arrayitem);
			item.style="list-style-type:none";
			//item.style="font-weight:bold";

	        // Set its contents:
	        item.appendChild(document.createTextNode(arrayitem));

	        // Add it to the list:
	        list.appendChild(item);

	    // Finally, return the constructed list:
	    return list;
		}

	function makeli(list,arrayitem,listName, isChecked) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('li');
			item.id = "item_".concat(listName).concat(arrayitem);

	        // Set its contents:
	        item.appendChild(document.createTextNode(arrayitem));

	        // Add it to the list:
			list.appendChild(item);
			makeDelete(document.getElementById('item_'.concat(listName).concat(arrayitem)),listName,arrayitem);
			makeCheckBox(document.getElementById('item_'.concat(listName).concat(arrayitem)), arrayitem, isChecked, listName);

	    // Finally, return the constructed list:
	    return list;
	}

	function makeCheckBox(domID, arrayitem, isChecked,listName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');	
			item.id = "item_".concat(listName).concat(arrayitem).concat(isChecked);
			item.class= "isChecked";
			item.type="checkbox";
			//Note: not able to display value of checkbox while website loads
			if(isChecked==1){
				item.checked = true;
				//console.log("0");
			}
			else
				item.checked= false;
			item.onclick=function(){updateCheckBox(item.id, listName,arrayitem,"abc");}
																	
			
	        // Add it to the list:
	        domID.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
		}


	function makeDelete(domID,listName,itemName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');
			item.id = "item_".concat(listName).concat(itemName);
			item.class= "del";
			item.type="button";
			item.value="x";
			item.onclick=function(){deleteItem(item.id, listName,'abc',itemName);}
																				
	        // Add it to the list:
	        domID.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
		}
	
	function makeDeleteList(domID,listName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');
			item.id = "list_".concat(listName);
			item.classList= "del2";
			item.type="button";
			item.value="Delete List";
			item.onclick=function(){deleteList(item.id, listName);}
																				
	        // Add it to the list:
	        domID.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
		}
	
	function makeInputText(domID,listName) {
	    // Create the list element:	    
	        // Create the list item:
	        var item = document.createElement('input');
			item.id = "input_".concat(listName);
			item.type="text";
			item.required="required";
			item.onkeydown=function(){enterPressed(event, item.id, listName,'abc');}											
	        // Add it to the list:
	        domID.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
		}

	


	function getlist(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				var myObj = JSON.parse(this.responseText);
				//document.getElementById("demo21").outerHTML = myObj;
				let i = 0;		
				while(myObj[i])
				{
					console.log(myObj[i].listName);
					//	document.getElementById('demo21').outerHTML=myObj[2].listName;
					//document.getElementById('demo21').innerHTML=myObj[i].listName;
					makeUL(document.getElementById('demo21'), myObj[i].listName);
					getItems(myObj[i].listName);
					i++;
				}
	 		}
		};
		var url = "getlist.php";
        xmlhttp.open("GET",url,true);
		xmlhttp.send();
		
	}
	
	function getItems(lName){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				let myObj = JSON.parse(this.responseText);
				//document.getElementById("demo21").outerHTML = myObj;
				let j = 0;	
				//makeUL(document.getElementById('demo21'), lName);
				makeDeleteList(document.getElementById('list_'.concat(lName)),lName);	
				while(myObj[j])
				{
					//console.log(myObj[i].listName);
					//	document.getElementById('demo21').outerHTML=myObj[2].listName;
					//document.getElementById('demo21').innerHTML=myObj[i].listName;
					//console.log(i);
					console.log(j);
					makeli(document.getElementById('list_'.concat(lName)), myObj[j].itemName,lName, myObj[j].isChecked);
//					//makeCheckBox(document.getElementById('list_'.concat(lName)), myObj[i].itemName, myObj[i].isChecked,lName);
					
					j++;
				}
				makeInputText(document.getElementById('list_'.concat(lName)),lName);
	 		}
		};
		var url = "getItem.php?l=".concat(lName);
        xmlhttp.open("GET",url,true);
		xmlhttp.send();
		
	}

	</script>


</head>
<body>

<div id="demo21"></div>

<script>
	getlist();	
</script>


	<div id="container1">
    <!-- html form to add list -->
	<h2>Add New List</h2>
	<form id="newList">
	   <span>Enter new list name:</br></span> 
		<input type="text" 
				name="newListName" 
					   required
					   		onkeydown="enterAddList(event,'newList')"/>
	   <input class="del2" 
	   			type="button" 
				   value="AddList"
				   		onclick="addList('newList')"/>
	</form>
	</div>

</body>
</html>
