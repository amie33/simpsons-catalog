/*javascript for my sort of secrue sight*/
//alert ("hello");

/****************************************************************************************************************************/
/**********************This function checks to make sure the users passwords match*******************************************/ 
var firstPass = document.getElementById('password_one'); 
var secondPass = document.getElementById('password_two');
var num = document.getElementById('number');
var len = document.getElementById('length');
//This function makes sure the passwords match in the create-account page
function validate()
{
	if(firstPass.value == secondPass.value)
	{
		document.getElementById('message').style.color = 'green';
		document.getElementById("message").style.fontFamily = "'simpsonfontregular', Fallback, chiller";
		document.getElementById('message').innerHTML = 'passwords match';
		
		//if the passwords match allow submit to be clickable 
			document.getElementById('subbutton').disabled = false;
	}
	else
	{
		document.getElementById('message').style.color = 'red';
		document.getElementById("message").style.fontFamily = "'simpsonfontregular', Fallback, chiller";
		document.getElementById('message').innerHTML = 'passwords do not match';
		//if the passwords don't match disable create account 
			document.getElementById('subbutton').disabled = true;
	}
	
}
/****************************************************************************************************************************/	
/*********The script down here is checking that the user is entering the correct length of a password and a number***********/
/****************When the user clicks on the password field, show the message box********************************************/
	firstPass.onfocus = function()
	{
	  document.getElementById("theMess").style.display = "block";
	}

// When the user clicks outside of the password field, hide the message box
	firstPass.onblur = function() 
	{
		document.getElementById("theMess").style.display = "none";
	}

// When the user starts to type something inside the password field use keyup to display the message
//use methods from javascript to make sure the password entered is valid or not 
function letsCheck() 
{
  // Validate numbers make sure there is a nubmer in the password
	  var numbers = /[0-9]/g;
	  if(firstPass.value.match(numbers)) {  
		num.classList.remove("invalid");
		num.classList.add("valid");
		document.getElementById('subbutton').disabled = false;
	  } else {
		num.classList.remove("valid");
		num.classList.add("invalid");
		document.getElementById('subbutton').disabled = true;
	  }
  
  // Validate length make sure it is AT LEAST 8 characters long 
	  if(firstPass.value.length >= 8) {
		len.classList.remove("invalid");
		len.classList.add("valid");
		document.getElementById('subbutton').disabled = false;
	  } else {
		len.classList.remove("valid");
		len.classList.add("invalid");
		document.getElementById('subbutton').disabled = true;
	  }
}

//////////////////////////////////////////////////////////////////////////////////////////////
















		
	