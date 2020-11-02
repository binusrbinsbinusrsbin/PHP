<?php

require('../model/database.php');
require('../model/initial.php');
require('../model/day_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
	if($action==NULL){
		$action='list';
	}
}
$current_day = getday($db);

if ($action == 'initial_db') {
    try {
        initial_db($db);
        header("Location: .");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'list') {
    try {
        $orders=getorders($db,$current_day);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}

else if ($action == 'next_day') {
    try {
        inc($db,$current_day);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}



include 'day_list.php';
