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
	function updateCheckBox(domItem,list,item) {
        xmlhttp = new XMLHttpRequest();
        //get DOM data and send to server php side
		
		let checkBox = domItem.childNodes[2];
		if (checkBox.checked == true){
        		var url = "updateCheckBox.php?q=1&l=".concat(list)
											.concat("&i=").concat(item);
			domItem.style='text-decoration:line-through;opacity: .5';
				
            xmlhttp.open("GET",url,true);
	        xmlhttp.send();
        } else {
        		var url = "updateCheckBox.php?q=0&l=".concat(list)
											.concat("&i=").concat(item);
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
		//var i = document.getElementById(domList).value;
			
		if(x==="Enter"){
			addItem(domList,l);
		}
	}
	function makeUL(domId,lName,lId) {
		// Create the list item:
		let item = document.createElement('ul');
		//item.id = "list_".concat(lName);
		item.id = "list_".concat(lId).concat(lName)
		item.style="list-style-type:none";
		// Set its contents:
		item.appendChild(document.createTextNode(lName));
		// Add it to the list:
		let domList = domId.appendChild(item);
	    // Finally, return the constructed list:
	    return domList;
	}
	function makeli(domList,arrayitem,listName, isChecked) {
	    // Create the list element:
	        // Create the list item:
	        let item = document.createElement('li');
			let itemText = document.createElement('span');
			//item.id = "item_".concat(listName).concat(arrayitem);
			
	        // Set its contents:
	        itemText.appendChild(document.createTextNode(arrayitem));
			item.appendChild(itemText);

	        // Add it to the list:
			// console.log(domList);
			let domItem = domList.appendChild(item);
			makeDelete(domItem,listName,arrayitem);
			makeCheckBox(domItem, arrayitem, isChecked, listName);

			// console.log(document.getElementById('item_'.concat(listName).concat(arrayitem)).childNodes[0]);
			domItem.childNodes[0].onclick=function(){makeChangeTextBox(domItem,arrayitem,listName);}

	    // Finally, return the constructed list:
	    //return list;
	}
	function makeChangeTextBox(domItem,arrayitem,listName){
		var domArrayItem = domItem.childNodes[0].innerText;
		// console.log(domArrayItem);
		var newItem = document.createElement("input");
		//console.log('item_'.concat(listName).concat(arrayitem));
		newItem.value = domArrayItem;
		newItem.style = 'width:100%; border:none; border-bottom:1px solid lightgrey; border-top:1px solid lightgrey;outline: none;padding:4px 20px;font:70% helvetica;';
		newItem.id = "new";
		
		//newItem.focus();

		var list = domItem.parentNode;
		list.insertBefore(newItem, domItem);
		domItem.previousSibling.focus();
		domItem.style='display:none';	
		newItem.onblur=function(){
			if(this.value != "")
				changeData(domItem,arrayitem,listName);
		}
		newItem.onkeydown=function(){
			if(this.value != "")
				changeDataOnEnter(event, domItem,arrayitem,listName);
		}
	}
	function changeDataOnEnter(event, domItem,arrayitem,listName){
		var x = event.key;
			
		if(x==="Enter"){
			//domItem.parentNode.lastChild.focus();
			if(domItem.nextSibling !==domItem.parentNode.lastChild)
				makeChangeTextBox(domItem.nextSibling,domItem.nextSibling.childNodes[0].innerText,listName);
				//makeli(domItem.parentNode,"",domItem.parentNode.childNodes[0],0)
			else
				domItem.parentNode.lastChild.focus();
		}
	}
	function changeData(domItem,arrayitem,listName, input_id){
		var i = domItem.previousSibling.value;			
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				domItem.childNodes[0].innerText=i;				///why not innerHTML
				//document.getElementById('item_'.concat(listName).concat(arrayitem)).id='item_'.concat(listName).concat(i);
				//domItem.style='display:block';
				let checkBox = domItem.childNodes[2];
				if (checkBox.checked == true)
					domItem.style='text-decoration:line-through;opacity: .5;display:block';
				else
					domItem.style='text-decoration:none;display:block';
					domItem.previousSibling.outerHTML = null;
			}
		};
		var url = "changeItem.php?l=".concat(listName)
								.concat("&i=").concat(i)
									.concat("&o=").concat(arrayitem);
		xmlhttp.open("GET",url,true);
		xmlhttp.send();	
	}
	function makeCheckBox(domItem, arrayitem, isChecked,listName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');	
			//	item.id = "item_input_".concat(listName).concat(arrayitem);
			item.class= "isChecked";
			item.type="checkbox";
			if(isChecked==1){
				item.checked = true;
				domItem.style='text-decoration:line-through;opacity: .5';
				//console.log("0");
			}
			else
				item.checked= false;
			item.onclick=function(){updateCheckBox(domItem, listName,arrayitem);}
																				
	        // Add it to the list:
	        domItem.appendChild(item);
	}
	function makeDelete(domItem,listName,itemName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');
			//item.id = "item_del_".concat(listName).concat(itemName); // not necessary , but need improvemnt in code to remove this
			item.class= "del";
			item.type="button";
			item.value="x";
			item.onclick=function(){deleteItem(domItem, listName, itemName);}
																				
	        // Add it to the list:
	        domItem.appendChild(item);
	}	
	function makeDeleteList(domList,listName) {
	    // Create the list element:
	        // Create the list item:
	        var item = document.createElement('input');
			//item.id = "list_".concat(listName);
			item.classList= "del2";
			item.type="button";
			item.value="Delete List";
			item.onclick=function(){deleteList(domList, listName);}
																				
	        // Add it to the list:
	        domList.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
	}	
	function makeInputText(domList,listName) {
	    // Create the list element:	    
	        // Create the list item:
	        var item = document.createElement('input');
			item.id = "input_".concat(listName);
			item.type="text";
			item.required="required";
			item.onkeydown=function(){enterPressed(event, domList, listName);}											
	        // Add it to the list:
	        domList.appendChild(item);
	    // Finally, return the constructed list:
	    //return list;
	}
	function getlist(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let myObj = JSON.parse(this.responseText);
				let i = 0;		
				while(myObj[i])
				{
					//console.log(myObj[i].listName);
					let domList = makeUL(document.getElementById('demo21'), myObj[i].listName, myObj[i].listID);
					getItems(domList, myObj[i].listName);
					i++;
				}
	 		}
		};
		var url = "getlist.php";
        xmlhttp.open("GET",url,true);
		xmlhttp.send();
	}
	function getItems(domList, lName){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				let myObj = JSON.parse(this.responseText);
				let j = 0;	
				makeDeleteList(domList, lName);	
				while(myObj[j])
				{
					makeli(domList, myObj[j].itemName, lName, myObj[j].isChecked);
					j++;
				}
				makeInputText(domList,lName);
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
