<!-- USING HTML AND PHP AND JS-->
<!-- Next step using correct declaration of id, so that items can be updated-->

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
	
	function updateCheckBox(itemId,list,item,userID) {
        xmlhttp = new XMLHttpRequest();
        console.log(userID);
        //get DOM data and send to server php side
		console.log(itemId);
        console.log(itemId.childNodes[2]);
        console.log((itemId).childNodes[2].chekced);
		
		var checkBox = itemId.childNodes[2];
		//console.log(document.getElementById(itemId).childNodes[2]);
		var data = document.getElementById("item_".concat(list).concat(item));
		if (checkBox.checked == true){
        		var url = "updateCheckBox.php?q=1&l=".concat(list)
											.concat("&i=").concat(item)
												.concat("&u=").concat(userID);
			data.style='text-decoration:line-through;opacity: .5';
				
            xmlhttp.open("GET",url,true);
	        xmlhttp.send();
        } else {
        		var url = "updateCheckBox.php?q=0&l=".concat(list)
											.concat("&i=").concat(item)
												.concat("&u=").concat(userID);
				data.style='text-decoration:none';
           	xmlhttp.open("GET",url,true);
    		xmlhttp.send();
        }
    }

	function deleteItem(str,l,u,i) {
		var r = confirm("Do you want to delete it!");
    	if (r == true) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				document.getElementById(str).outerHTML = null;
				document.getElementById('item_'.concat(l).concat(i)).outerHTML = null;
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
			var itemText = document.createElement('span');
			item.id = "item_".concat(listName).concat(arrayitem);
			
	        // Set its contents:
	        itemText.appendChild(document.createTextNode(arrayitem));
			item.appendChild(itemText);

	        // Add it to the list:
			list.appendChild(item);
			makeDelete(document.getElementById('item_'.concat(listName).concat(arrayitem)),listName,arrayitem);
			makeCheckBox(document.getElementById('item_'.concat(listName).concat(arrayitem)), arrayitem, isChecked, listName);

			console.log(document.getElementById('item_'.concat(listName).concat(arrayitem)).childNodes[0]);
			document.getElementById('item_'.concat(listName).concat(arrayitem)).childNodes[0].onclick=function(event){makeChangeText(this,listName);}

	    // Finally, return the constructed list:
	    return list;
	}

	function makeChangeText(aitem, listName){
		var arrayitem = aitem.innerText;
		console.log(arrayitem);
		var newItem = document.createElement("input");
		console.log('item_'.concat(listName).concat(arrayitem));
		newItem.value = document.getElementById('item_'.concat(listName).concat(arrayitem)).innerText;
		newItem.style = 'width:70%; border:none; border-bottom:1px solid lightgrey; border-top:1px solid lightgrey; padding:8px 20px;';
		newItem.id = "new";
		
		//newItem.focus();

		var list = document.getElementById("list_".concat(listName));
		list.insertBefore(newItem, document.getElementById('item_'.concat(listName).concat(arrayitem)));
		document.getElementById('new').focus();
		document.getElementById('item_'.concat(listName).concat(arrayitem)).style='display:none';
		// document.getElementById('item_del_'.concat(listName).concat(arrayitem)).style='display:block';
		// document.getElementById('item_input_'.concat(listName).concat(arrayitem)).style='display:block';
		
		newItem.onkeydown=function(){changeData(event, arrayitem, listName, "new");}											
	}

	function changeData(event, arrayitem, listName, input_id){
		var x = event.key;
		var i = document.getElementById(input_id).value;
			
		if(x==="Enter"){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				
					//document.getElementById('item_'.concat(listName).concat(arrayitem)).id='item_input_'.concat(listName).concat(i);
					//document.getElementById('item_'.concat(listName).concat(arrayitem)).id='item_del_'.concat(listName).concat(i);
					console.log( 'item_'.concat(listName).concat(i));
					document.getElementById('item_'.concat(listName).concat(arrayitem)).childNodes[0].innerText=i;				///why not innerHTML
					console.log(document.getElementById('item_'.concat(listName).concat(arrayitem)).childNodes[0].innerText); ///childNodes[0]
					document.getElementById('item_'.concat(listName).concat(arrayitem)).id='item_'.concat(listName).concat(i);
					//document.getElementById('item_'.concat(listName).concat(i)).childNodes[0].innerText=i;
					console.log( 'item_'.concat(listName).concat(i));
					console.log(document.getElementById('item_'.concat(listName).concat(i)).childNodes[0].innerText);
					document.getElementById('item_'.concat(listName).concat(i)).style='display:block';
					//document.getElementById('item_del_'.concat(listName).concat(i)).style='display:block';
					// console.log( 'item_input_'.concat(listName).concat(i));
					// console.log(document.getElementById('item_input_'.concat(listName).concat(i)).innerText);
					// document.getElementById('item_input_'.concat(listName).concat(i)).style='display:block';
					document.getElementById(input_id).outerHTML = null;
					//location.reload();
				console.log(3);
				}
			};
			//console.log(userID);
			//get DOM data and send to server php side
			//var i = document.getElementById(str).value;
			var url = "changeItem.php?l=".concat(listName)
									.concat("&i=").concat(i)
										.concat("&o=").concat(arrayitem);
			xmlhttp.open("GET",url,true);
			xmlhttp.send();	
		}
	}



	function makeCheckBox(domID, arrayitem, isChecked,listName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');	
			//	item.id = "item_input_".concat(listName).concat(arrayitem);
			item.class= "isChecked";
			item.type="checkbox";
			var data = document.getElementById("item_".concat(listName).concat(arrayitem));
			//Note: not able to display value of checkbox while website loads
			if(isChecked==1){
				item.checked = true;
				data.style='text-decoration:line-through;opacity: .5';
				//console.log("0");
			}
			else
				item.checked= false;
			item.onclick=function(){updateCheckBox(domID, listName,arrayitem,"abc");}
																	
			
	        // Add it to the list:
	        domID.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
		}


	function makeDelete(domID,listName,itemName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');
			item.id = "item_del_".concat(listName).concat(itemName); // not necessary , but need improvemnt in code to remove this
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
					//console.log(j);
					makeli(document.getElementById('list_'.concat(lName)), myObj[j].itemName,lName, myObj[j].isChecked);
					//makeCheckBox(document.getElementById('list_'.concat(lName)), myObj[i].itemName, myObj[i].isChecked,lName);
					
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
