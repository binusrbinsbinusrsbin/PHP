<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Current Orders Report</h1>
        <h2>Orders Baked but not delivered</h2>

	<?php if($bakeds==null):
		echo "No baked orders";
	endif; ?>

	<?php foreach ($bakeds as $baked) : ?>
		<?php echo "ID:" . $baked['id'] . " User " . $baked['name'] ; ?>
		<br>
	<?php endforeach; ?>

        <h2>Orders Preparing (in the oven)</h2>

	<?php foreach ($preps as $prep) : ?>
		<?php echo "ID:" . $prep['id'] . " User " . $prep['name'] ; ?>
		<br>
	<?php endforeach; ?>
        <br> 

        <!--Button for marking oldest preparing pizza as baked -->
	<form action="index.php" method="post" >
		<input type="hidden" name="action" value="change_to_baked">
		<input type="submit" value="Mark Oldest Pizza Baked" />
	</form>
        <br>  
    </section>
</main>
<?php include '../view/footer.php'; 
