<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>User List</h1>
        <table>
            <tr>
                <th>Username</th>
		<th>Room</th>
            </tr>
		<?php foreach ($users as $user) : ?>
		<tr>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['room']; ?></td>
			<td>
			<form action="." method="post">
			<input type="hidden" name="action" value="delete_user">
			<input type="hidden" name="name" value="<?php echo $user['username']; ?>">
			<input type="submit" value="Delete">
			</form>
			</td>
		</tr>
		<?php endforeach; ?>


        </table>
        <p class="last_paragraph">
            <a href="index.php?action=show_add_form">Add user</a>
        </p>
    </section>
</main>
<?php include '../view/footer.php'; 
