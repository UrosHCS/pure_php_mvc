<style type="text/css">
	table.table {
		min-width: 1300px;
	}
	tr.border-top td {
		border-top: 1pt solid lightgray;
		padding: 5px 0px 5px 0px;
		text-align: center;
	} 
</style>

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

		<tr class="border-top">
			<td><?= $user->id ?></td>
			<td><?= $user->username ?></td>
			<td><?= $user->password ?></td>
		</tr>

<?php endforeach; ?>

	</tbody>

</table>