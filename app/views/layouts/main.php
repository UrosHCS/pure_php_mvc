<!DOCTYPE html>
<html>
<head>
	<title>MVC app</title>
	<link rel="stylesheet" href="/css/styles.css">
	<!-- Other CSS links are inserted dynamicaly here -->
	<?= $this->cssLinks ?>
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
				<a href="/logout">Logout (<?= $this->authUsername(); ?>)</a>
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

	<script src="/js/script.js"></script>
	<!-- Other scripts are inserted dynamicaly here -->
	<?= $this->scripts ?>

</body>
</html>