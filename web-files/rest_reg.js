function validate(){
		

	
	var email = document.getElementById("email").value;
	
	var parse2 = /^[0-9a-zA-Z]+@{1}[0-9a-zA-Z]+\.{1}[0-9a-zA-Z]+$/;
	var result2 = parse2.test(email);
	
	if((email == "") || (result2 == true)){		
		alert("Email entry is empty or is in an incorrect format. Please properly fill in this input  \n");
		document.getElementById("email").focus();
		return false;
	}
	
	var address = document.getElementById("address").value;
	var parse3 = /^\d+\s+[A-z]+$/i;
	var result3 = parse3.test(address);
		
	if((address == null) || (result3 == false)){
		alert("Address entry is empty or is in an incorrect format. Please properly fill in this input \n");
		document.getElementById("address").focus();
		return false;
	}
	
	var zip = document.getElementById("zip").value;

	if(zip ==null){		
		alert("Zipcode entry is empty. Please fill in this input \n");
		document.getElementById("zip").focus();
		return false;
	}
	
	var pass = document.getElementById("password").value;

	if(pass == null){		
		alert("Password entry is empty. Please fill in this input \n");
		document.getElementById("password").focus();
		return false;
	}
	
	var cpass = document.getElementById("cPassword").value;

	if(cpass == null){		
		alert("Confirm Password entry is empty. Please fill in this input \n");
		document.getElementById("cPassword").focus();
		return false;
	}
	
	var phone = document.getElementById("phone").value;

	if(phone == null){		
		alert("The phone number entry is empty. Please fill in this input \n");
		document.getElementById("phone").focus();
		return false;
	}
	
	else{
		return true;
	}
}