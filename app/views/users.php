<?php $this->registerCSS('users-styles.css'); ?>
<?php $this->registerScript('users-alert.js'); ?>

<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>USERNAME</th>
			<th>CREATED AT</th>
		</tr>
	</thead>

	<tbody>
			
<?php foreach ($users as $user): ?>

<?php $highlight = ($user->username == $this->authUsername()) ? 'highlight' : ''; ?>

		<tr class="border-top <?= $highlight ?>">
			<td><?= $user->id ?></td>
			<td><?= $user->username ?></td>
			<td><?= date('d.m.Y. H:i:s', strtotime($user->created_at)); ?></td>
		</tr>

<?php endforeach; ?>

	</tbody>

</table>
