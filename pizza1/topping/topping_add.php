<?php include '../view/header.php'; ?>
<main>
    <h1>Add topping</h1>
    <form action="index.php" method="post" id="add_topping_form">
        <input type="hidden" name="action" value="add_topping">
        <label>topping:</label>
        <input type="text" name="topping_name" />
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Add Topping" />
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_toppings">View Topping List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>
