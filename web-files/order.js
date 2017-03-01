function validate(){
	var numerItems = document.getElementsByName("quantity[]");
	var address = document.getElementById("address").value;
	var zip = document.getElementById("zip").value;
	var count = 0;
	var zipPatter = /^[0-9]{5}$/;
	var addressPattern = /^[0-9]+\s[a-zA-Z\s]+$/;
	var errorCheck = true;
	var errorMessage ="";

	for (var x = 0; x < numerItems.length; x++){
		if (numerItems[x].value <0){
			errorMessage+=("You cannot order a negative number of an item.\n");
			document.getElementsByName("quantity[]")[x].style.backgroundColor = "red";
			errorCheck = false;
		}
		count += numerItems[x].value;
	}
	if (count  < 1){
		errorMessage+="You must select at least one item to order.\n";
		errorCheck = false;

	}
	if(zipPatter.test(zip)==false ){
		errorMessage+="Please re-enter the zip code for the delivery location.\n";
		 document.getElementById("zip").style.backgroundColor = "red";
		 errorCheck = false;
	}
	if(addressPattern.test(address)==false){
		
		errorMessage+="Please re-enter your delivery address in a proper address format.\n";
		document.getElementById("address").style.backgroundColor = "red";
		errorCheck = false;
	}

	if(errorCheck==false){
		alert(errorMessage);
		return false
	}
	else{
		return true;
	}
}
function getDefaultAddress(){
	new Ajax.Request( "address.php", 
	{ 
		method: "post", 
		onSuccess: displayResult
	} 
	);
	new Ajax.Request( "zip.php", 
	{ 
		method: "post", 
		onSuccess: displayResult2
	} 
	);
	new Ajax.Request( "state.php", 
	{ 
		method: "post", 
		onSuccess: displayResult3
	} 
	);
}
function displayResult(ajax){
	$("address").value = ajax.responseText;
}
function displayResult2(ajax){
	$("zip").value = ajax.responseText;
}
function displayResult3(ajax){
	$("state").value = ajax.responseText;
}

function specialColor(){
	var specialType = document.getElementById("special").innerHTML;
	var color;
	switch(specialType){
		case 'Italian':
			color = '#2F329F';
			break;
		case 'Chinese':
			color = '#ee7600';
			break;
		case 'French':
			color = '#93aa3d';
			break;
		case 'Vietnamese':
			color = '#600049';
			break;
		case 'Japanese':
			color = '#ff66ff';
			break;
		case 'American':
			color = '#3399ff';
			break;
		case 'Mexican':
			color = '#ffffcc';
			break;
		case 'Indian':
			color = '#ffff66';
			break;
	}
		document.getElementsByClassName('restInfo')[0].style.backgroundColor = color;
			var x;
			for(x = 0; x < document.getElementsByClassName('menuBlock').length -1 ; x++){
				document.getElementsByClassName('menuBlock')[x].style.backgroundColor = color;
				document.getElementsByClassName('menuPrice')[x].style.backgroundColor = color;
			}
			x++;
			document.getElementById('confirm').style.backgroundColor = color;
}