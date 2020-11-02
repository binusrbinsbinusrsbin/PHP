<?php include '../view/header.php'; ?>
<main>
    <h1> Order Pizza </h1>

	<form action="index.php" method="post" id="pizza_form">
	<input type="hidden" name="action" value="pizza">
	
	<h2>Pizza Size:</h2>

	<?php foreach($sizes as $size): ?>
		<input type="radio" name="size" value="<?php echo $size['size']; ?>">
		<?php echo $size['size']; ?>
	<?php endforeach; ?>

	<h2>Toppings:</h2>
	<?php foreach($toppings as $topping): ?>
		<input type="checkbox" name="topping[]" value="<?php echo $topping['topping']; ?>">
		<?php echo $topping['topping']; ?>
		<br>
	<?php endforeach; ?>


	<br>
	<label>Username: </label>
		<select name="id">
			<?php foreach($users as $user) :
				if($id==$user['id']): ?>
					<option value="<?php echo $user['id']; ?>">
					<?php echo $user['username']; ?>
					</option>
				<?php endif;
			endforeach; ?>
			<?php foreach($users as $user) :
				if($id!=$user['id']): ?>
					<option value="<?php echo $user['id']; ?>">
					<?php echo $user['username']; ?>
					</option>
				<?php endif;
			endforeach; ?>

		</select>
		<input type="submit" value="Order Pizza">
	</form>

</main>
<?php include '../view/footer.php'; 
