<!DOCTYPE html>
<html>
<head>
	<title>MVC app</title>
	<link rel="stylesheet" href="/app/resources/styles.css">
</head>
<body>

	<div class="navbar">

<?php if ($isLoggedIn): ?>

		<ul>
			<li>
				<a href="/home">Home</a>
			</li>
			<li>
				<a href="/users">Users</a>
			</li>
			<li>
				<a href="/logout">Logout (<?= $_SESSION['username'] ?? 'no one' ?>)</a>
			</li>
		</ul>

<?php endif; ?>

	</div>
	
	<div class="content">
		<?= $this->content ?>
		
	</div>

	<div class="footer">
		<div class="center">
			MVC app by Uroš Anđelić <?= date('Y') ?>
		</div>
	</div>

	<script src="/app/resources/script.js"></script>

</body>
</html>