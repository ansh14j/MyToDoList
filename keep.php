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
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">


	<script>
	function updateCheckBox(domItem,lId,iId) {
        xmlhttp = new XMLHttpRequest();
        //get DOM data and send to server php side
		
		let checkBox = domItem.childNodes[2];
		if (checkBox.checked == true){
        		var url = "updateCheckBox.php?q=1&l=".concat(lId)
											.concat("&i=").concat(iId);
			domItem.style='text-decoration:line-through;opacity: .5';
				
            xmlhttp.open("GET",url,true);
	        xmlhttp.send();
        } else {
        		var url = "updateCheckBox.php?q=0&l=".concat(lId)
											.concat("&i=").concat(iId);
				domItem.style='text-decoration:none';
           	xmlhttp.open("GET",url,true);
    		xmlhttp.send();
        }
    }
	function deleteItem(domItem,l,i) {
		// var r = confirm("Do you want to delete it!");
    	// if (r == true) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				domItem.outerHTML = null;
				}
			};
			//console.log(userID);
			//get DOM data and send to server php side
			var url = "deleteItem.php?l=".concat(l)
											.concat("&i=").concat(i);
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
		// }
	}
	function deleteList(domList, l){
		var r = confirm("Do you want to delete it!");
    	if (r == true) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					domList.outerHTML = null;
				}
			};
			//console.log(userID);
			//get DOM data and send to server php side
			var url = "deleteList.php?l=".concat(l);
			xmlhttp.open("GET",url,true);
			xmlhttp.send();	
		}
	}
	function addItem(domList,l) {
		var i = domList.lastChild.value;
		if(i != "")
		{
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					domList.lastChild.outerHTML = null;
					makeli(domList,i,l,0);
					makeInputText(domList,l);
				}
			};
			var url = "addItem.php?l=".concat(l)
											.concat("&i=").concat(i);
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
		}
	}
	function addList(str) {
		var l = document.getElementById(str).elements[0].value;
		if(l != "")
		{
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				//update DOM element without using recieved data
				//location.reload();
					let domList = makeUL(document.getElementById('demo21'), l);
					makeDeleteList(domList,l);
					makeInputText(domList,l);
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
	function enterAddList(event,str){
		var x = event.key;
			
		if(x==="Enter"){
			addList(str);
		}
	}
	function enterPressed(event,domList,l){
		var x = event.key;
			
		if(x==="Enter"){
			addItem(domList,l);
		}
	}
	function makeUL(domId,lName,lId) {
		// Create the list item:
		let item = document.createElement('ul');
		item.id = "lId";
		// Set its contents:
		item.appendChild(document.createTextNode(lName));
		// Add it to the list:
		let domList = domId.appendChild(item);
	    // Finally, return the constructed list:
	    return domList;
	}
	function makeli(domList,arrayitem,iId, lId, isChecked) {
	    // Create the list element:
	        // Create the list item:
	        let item = document.createElement('li');
			let itemText = document.createElement('span');
			
	        // Set its contents:
	        itemText.appendChild(document.createTextNode(arrayitem));
			item.appendChild(itemText);

	        // Add it to the list:
			let domItem = domList.appendChild(item);
			domItem.id = "iId";
			makeDelete(domItem,lId,iId);
			makeCheckBox(domItem, iId, isChecked, lId);

			domItem.childNodes[0].onclick=function(){makeChangeTextBox(domItem,iId,lId);}
	}
	function makeChangeTextBox(domItem,iId,lId){
		var domArrayItem = domItem.childNodes[0].innerText;
		var newItem = document.createElement("input");
		newItem.value = domArrayItem;
		newItem.id = "new";
		
		var list = domItem.parentNode;
		list.insertBefore(newItem, domItem);
		domItem.previousSibling.focus();
		domItem.style='display:none';	
		newItem.onblur=function(){
			if(this.value != "")
				changeData(domItem,iId,lId);
		}
		newItem.onkeydown=function(){
			if(this.value != "")
				changeDataOnEnter(event, domItem,iId,lId);
		}
	}
	function changeDataOnEnter(event, domItem,iId,lId){
		var x = event.key;
			
		if(x==="Enter"){
			if(domItem.nextSibling !==domItem.parentNode.lastChild){
			// 	console.log(domItem.nextSibling.id);
			// console.log(domItem.nextSibling);
			// console.log(domItem);
				changeData(domItem, iId, lId);
				makeChangeTextBox(domItem.nextSibling,domItem.nextSibling.id,lId);
			}
			else
				domItem.parentNode.lastChild.focus();
		}
	}
	function changeData(domItem,iId,lId, input_id){
		var i = domItem.previousSibling.value;			
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				domItem.childNodes[0].innerText=i;				///why not innerHTML
				let checkBox = domItem.childNodes[2];
				if (checkBox.checked == true)
					domItem.style='text-decoration:line-through;opacity: .5;display:block';
				else
					domItem.style='text-decoration:none;display:block';
					domItem.previousSibling.outerHTML = null;
			}
		};
		var url = "changeItem.php?l=".concat(lId)
								.concat("&i=").concat(i)
									.concat("&o=").concat(iId);
		xmlhttp.open("GET",url,true);
		xmlhttp.send();	
	}
	function makeCheckBox(domItem, iId, isChecked,lId) {
	        // Create the list item:
	        var item = document.createElement('input');	
			item.class= "isChecked";
			item.type="checkbox";
			if(isChecked==1){
				item.checked = true;
				domItem.style='text-decoration:line-through;opacity: .5';
			}
			else
				item.checked= false;
			item.onclick=function(){updateCheckBox(domItem, lId, iId);}
																				
	        // Add it to the list:
	        domItem.appendChild(item);
	}
	function makeDelete(domItem,lId,iId) {
	        // Create the list item:
	        var item = document.createElement('input');
			item.class= "del";
			item.type="button";
			item.value="x";
			item.onclick=function(){deleteItem(domItem, lId, iId);}
																				
	        // Add it to the list:
	        domItem.appendChild(item);
	}	
	function makeDeleteList(domList,lId) {
	        // Create the list item:
	        var item = document.createElement('input');
			item.classList= "del2";
			item.type="button";
			item.value="Delete List";
			item.onclick=function(){deleteList(domList, lId);}
																				
	        // Add it to the list:
	        domList.appendChild(item);
	}	
	function makeInputText(domList,lId) {
	        // Create the list item:
	        var item = document.createElement('input');
			//item.id = "input_".concat(lId);
			item.type="text";
			item.required="required";
			item.onkeydown=function(){enterPressed(event, domList, lId);}											
	        // Add it to the list:
	        domList.appendChild(item);
	}
	function getlist(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let myObj = JSON.parse(this.responseText);
				let i = 0;		
				while(myObj[i])
				{
					let domList = makeUL(document.getElementById('demo21'), myObj[i].listName, myObj[i].listID);
					getItems(domList, myObj[i].listID);
					i++;
				}
	 		}
		};
		var url = "getlist.php";
        xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	function getItems(domList, lId){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let myObj = JSON.parse(this.responseText);
				let j = 0;	
				makeDeleteList(domList, lId);	
				while(myObj[j])
				{
					makeli(domList, myObj[j].itemName, myObj[j].itemID, lId, myObj[j].isChecked);
					j++;
				}
				makeInputText(domList,lId);
	 		}
		};
		var url = "getItem.php?l=".concat(lId);
        xmlhttp.open("GET",url,true);
		xmlhttp.send();		
	}
	</script>
</head>
<body style="font-family: 'Montserrat', sans-serif;">


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
