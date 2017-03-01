function chk_blank_clogin() {

	var cust_name = document.getElementById('cName').value;
    var cust_pass = document.getElementById('cPass').value;

  if (cust_name == "") {
	alert("Username field cannot be empty! Please enter your username.");
    document.getElementById("cName").focus();
    return false;
  } else {
		if (cust_pass == "") {
		alert("Password field cannot be empty! Please enter your password.");
		document.getElementById("cPass").focus();
		return false;
		} else {
			return true;
		}
	}

}

function chk_blank_rlogin() {

    var rest_name = document.getElementById('rName').value;
    var rest_pass = document.getElementById('rPass').value;

  if (rest_name == "") {
	alert("Restaurant ID field cannot be empty! Please enter your ID.");
    document.getElementById("rName").focus();
    return false;
  } else {
		if (rest_pass == "") {
		alert("Password field cannot be empty! Please enter your password.");
		document.getElementById("rPass").focus();
		return false;
		} else {
			return true;
		} 
  }
}

function bold_cname(){
	var cName = document.getElementById("cName");

	cName.style.fontWeight="bold";
	cName.style.textAlign="center";
}

function bold_rname(){
	var cName = document.getElementById("rName");

	rName.style.fontWeight="bold";
	rName.style.textAlign="center";
}

function newRest(){
	new Ajax.Request( "randomRest.php", 
	{ 
		method: "post", 
		onSuccess: print
	} 
	);
}
function print(ajax){
	$("featured").innerHTML = ajax.responseText;
}
