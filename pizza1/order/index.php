<?php
require('../model/database.php');
require('../model/order_db.php');
require('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_orders';
    }
}
if ($action == 'list_orders') {
    try {
	$bakeds=getbaked($db);
	$preps=getprep($db);
	include('order_list.php');

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}
else if ($action == 'change_to_baked') {

    try {
	bake($db);
	header("Location: .");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

