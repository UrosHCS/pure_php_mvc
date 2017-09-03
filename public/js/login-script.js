(function () {

	var loginButton = document.getElementsByClassName('btn-login-form')[0];
	var registerButton = document.getElementsByClassName('btn-register-form')[0];

	var loginForm = document.getElementsByClassName('login-form')[0];
	var registerForm = document.getElementsByClassName('register-form')[0];

	registerForm.style.display = 'none';

	loginButton.addEventListener("click", function() {
		toggleVisible(loginForm);
		toggleVisible(registerForm); 
	});
	registerButton.addEventListener("click", function() {
		toggleVisible(loginForm);
		toggleVisible(registerForm); 
	});

	var toggleVisible = function(element){
	    if (element.style.display === 'none'){
	        element.style.display = 'block';
	    }else{
	        element.style.display = 'none';
	    }
	};
	
})();