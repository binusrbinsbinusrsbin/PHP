<?php

require('../model/database.php');
require('../model/day_db.php');
require('../model/order_db.php');
require('../model/size_db.php');
require('../model/topping_db.php');
require('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
	if($action==NULL){
		$action='list_options';
	}
}
if ($action == 'list_options') {
    try {
	$users=get_users($db);
	$toppings=get_toppings($db);
	$sizes=get_sizes($db);
	include('student_welcome.php');

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'show_form') {
    try {
	$id=filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
	$users=get_users($db);
	$toppings=get_toppings($db);
	$sizes=get_sizes($db);
	include('order_pizza.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'pizza') {
    try {
	$users=get_users($db);
	$size=filter_input(INPUT_POST,'size',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$toppings=get_toppings($db);
	$sizes=get_sizes($db);

	$usertoppings=filter_input(INPUT_POST,'topping',FILTER_DEFAULT,FILTER_REQUIRE_ARRAY);


	$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
	$current_day = getday($db);
	newpizza($db,$id,$current_day,$size,$usertoppings);
	$bakeds=usrbaked($db,$id);
	$preps=usrprep($db,$id);
	$usrtopps=usrtopps($db);


	include('student_welcome.php');

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'table') {
    try {
	$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
	$users=get_users($db);
	$toppings=get_toppings($db);
	$sizes=get_sizes($db);
	$bakeds=usrbaked($db,$id);
	$preps=usrprep($db,$id);
	$usrtopps=usrtopps($db);

	include('student_welcome.php');

	//header("Location: .");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'ack') {
    try {
	$id=filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
	$pid=filter_input(INPUT_POST,'pid',FILTER_VALIDATE_INT);
	$users=get_users($db);
	$toppings=get_toppings($db);
	$sizes=get_sizes($db);
	$bakeds=fin($db,$pid,$id);
	$preps=usrprep($db,$id);
	$usrtopps=usrtopps($db);

	include('student_welcome.php');

	//header("Location: .");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

