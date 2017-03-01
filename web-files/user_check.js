function checkEmail(valueIn) {
	new Ajax.Request("user_confirm2.php",
	{
		method:"POST",
		parameters: {name:valueIn},
		onSuccess: displayResult
	} );		
}

function displayResult(ajax) {
	var e = ajax.responseText;
	$('emailbox').innerHTML = e;
	if (e == '&#x2715;') {
		$('e').style.backgroundColor="red";
		$('e').style.color="white";
		$('e').focus();

	}
	else {
		$('e').style.backgroundColor="green";
		$('e').style.color="white";	
	}
} 

function validate() {
	var f = document.getElementById("f").value;
	if (f == ""){
		alert("First name is blank ");
		return false;
	}
		var l = document.getElementById("l").value;
	if (l == ""){
		alert("Last name is blank ");
		return false;
	}
		var p = document.getElementById("p").value;
	if (p == ""){
		alert("Password is blank");
		return false;
	}
		var pv = document.getElementById("pv").value;
	if (pv== ""){
		alert("Password verify is blank ");
		return false;
	}
		var a = document.getElementById("a").value;
	if (a == ""){
		alert("Address is blank ");
		return false;
	}
		var z = document.getElementById("z").value;
	if (z == ""){
		alert("Zip is blank");
		return false;
	}

}