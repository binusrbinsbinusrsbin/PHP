<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Welcome Student!</h1>
        <h2>Available Sizes</h2>
	<?php
		foreach ($sizes as $size) :
			echo $size['size'] . " ";
		endforeach;
	?>
	
	<br> 
	<br>
        <h2>Available Toppings</h2>



	<?php
		foreach ($toppings as $topp) :
			echo $topp['topping'] . " ";
		endforeach;
	?>
		
	<br>
	<br>
	<form action="index.php" method="post" id="select_user">
	<label>Username: </label>
		<input type="hidden" name="action" value="table">
		<select name="id">
			<?php foreach($users as $user) : ?>
				<?php if($id==$user['id']): ?>
				<option value="<?php echo $user['id']; ?>">
				<?php echo $user['username']; ?>
				</option>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php foreach($users as $user) : ?>
				<?php if($id!=$user['id']): ?>
				<option value="<?php echo $user['id']; ?>">
				<?php echo $user['username']; ?>
				</option>
				<?php endif; ?>
			<?php endforeach; ?>

		</select>
		<input type="submit" value="Select Your Username">
	</form>


	<?php if($id!=null): ?>
		<h2>please acknowledge receipt of delivery of any baked orders</h2>
		<br>
		<table>
		<?php foreach($bakeds as $baked) : ?>
			<tr>
				<td><?php echo $baked['id']; ?></td>
				<td><?php echo $baked['size']; ?></td>
				<td><?php echo $baked['status']; ?></td>

			<?php foreach($usrtopps as $usrtopp) : ?>
				<?php if($baked['id']==$usrtopp['order_id']): ?>
					<td><?php echo $usrtopp['topping']; ?></td>
				<?php endif; ?>
			<?php endforeach; ?>	


			<td>

			<form action="." method="post">
			<input type="hidden" name="action" value="ack">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input type="hidden" name="pid" value="<?php echo $baked['id']; ?>">
			<input type="submit" value="Delivery Complete">
			</form>
			</td>
			<tr> 

		<?php endforeach; ?>
		
		<?php foreach($preps as $prep) : ?>
		<tr>
			<td><?php echo $prep['id']; ?></td>
			<td><?php echo $prep['size']; ?></td>
			<td><?php echo $prep['status']; ?></td>
			<?php foreach($usrtopps as $usrtopp) : ?>
				<?php if($prep['id']==$usrtopp['order_id']): ?>
					<td><?php echo $usrtopp['topping']; ?></td>
				<?php endif; ?>
			<?php endforeach; ?>	
		<tr>

		<?php endforeach; ?>		

		</table>
	<?php endif; ?>




	<p class="last paragraph">
		<a href="index.php?action=show_form&id=<?php echo $id; ?>">Order Pizza</a>
	</p>

    </section>
</main>
<?php include '../view/footer.php'; 
