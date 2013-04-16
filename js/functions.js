// JavaScript Document

// Validate Register form
function validate(id) {
	form = 	document.getElementById(id);
	if(form.fname.value==""){
		alert("Enter First name");
		return;
	}
	
	if( !form.lname.value || form.lname.value==""){
		alert("Enter Last name");
		return;
	}
	
	if(!form.passwd.value || form.passwd.value==""){
		alert("Enter password");
		return;
	}
	
	if(form.passwd.value.length < 6){
		alert("Password must be at least 6 simvol");
		return;
	}
	
	if(!form.fn.value || form.fn.value==""){
		alert("Enter FN");
		return;
	}
	
	txt = form.email.value;
	if(txt==""){
		alert("Enter E-mail");
		return;
	}
	
	if(txt.indexOf("@")== -1){
		alert("Enter corectly E-mail address");
		return;
	}
	
	if(txt.indexOf(".")== -1){
		alert("Enter E-mail address:(anton@anton.ru)");
		return;
	}
	
	form.submit();
}


// Validate Login Form
function validate(id) {
	form = 	document.getElementById(id);
	if(form.email.value=="") {
		alert("Enter E-mail!");	
		return;
	}
	
	txt = form.password.value;
	if(txt=="") {
		alert("Enter Password!");	
		return;
	}
	
	if(txt.length > 6) {
		alert("Password must be at least 6 simvol");
		return;
	}
}