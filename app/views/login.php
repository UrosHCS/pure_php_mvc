<style type="text/css">
	.form {
		margin-left: 20px;
	}
	.form-label, .form-button {
		margin-top: 5px;
	}
	.error {
		background-color: #ff8989;
		padding: 10px;
	}
</style>

<h2>Please login or register</h2>

<?php if (isset($error)): ?>

<div class="error">
	<?= $error ?>
</div>

<?php endif; ?>

<div class="forms">

	<div class="form">

		<form action="/login" method="POST">

			<div class="form-label">
				<label for="login-username">Username</label>
			</div>

			<div class="form-block">
				<input value="<?= $user->username ?? '' ?>" id="login-username" type="text" name="username" placeholder="username" required>
			</div>

			<div class="form-label">
				<label for="login-password">Password</label>
			</div>

			<div class="form-label">
				<input id="login-password" type="password" name="password" placeholder="Password" required>
			</div>

			<div class="form-button">
				<input type="submit" value="Login">
			</div>


		</form>
	</div>

	<hr>
	<br>

	<div class="form">

		<form action="/register" method="POST">

			<div class="form-label">
				<label for="register-username">Username</label>
			</div>

			<div class="form-block">
				<input value="<?= $user->username ?? '' ?>" id="register-username" type="text" name="username" placeholder="username" required
			</div>

			<div class="form-label">
				<label for="register-password">Password</label>
			</div>

			<div class="form-block">
				<input id="register-password" type="password" name="password" placeholder="password" required>
			</div>

			<div class="form-label">
				<label for="register-confirm-password">Confirm password</label>
			</div>

			<div class="form-block">
				<input id="register-confirm-password" type="password" name="confirm" placeholder="Confirm password" required>
			</div>

			<div class="form-button">
				<input type="submit" value="Register">
			</div>



		</form>
	</div>
</div>

<script>
	var password = document.getElementById("register-password")
	var confirm_password = document.getElementById("register-confirm-password");
	var borderColor = confirm_password.style.borderColor;

	function validatePassword() {
		if(password.value != confirm_password.value) {
        	confirm_password.style.borderColor = "#E34234";
		} else {
			confirm_password.style.borderColor = borderColor;
		}
	}

	password.oninput = validatePassword;
	confirm_password.oninput = validatePassword;
</script>