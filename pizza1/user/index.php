<?php

require('../model/database.php');
require('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_users';
    }
}

if ($action == 'list_users') {
    try {
        $users = get_users($db);
        include('user_list.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
    }
} else if ($action == 'show_add_form') {
    include('user_add.php');
} else if ($action == 'add_user') {
    $name = filter_input(INPUT_POST, 'name');
    $roomnum=filter_input(INPUT_POST,'roomnum',FILTER_VALIDATE_INT);
    if ($name == NULL || $name == FALSE) {
        $error = "Invalid user name";
        include('../errors/error.php');
        exit();  // we're done with this response
    }
    if ($name == NULL || $name == FALSE) {
        $error = "Invalid room number";
        include('../errors/error.php');
        exit();  // we're done with this response
    }
    try {
        add_user($db, $name,$roomnum);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();  // needed here to avoid redirection of next line
    }
    // Redirect back to index.php (see pp. 164-165)
    // (don't try to include index.php inside index.php)
    header("Location: .");
}

 else if ($action == 'delete_user') {
    $name = filter_input(INPUT_POST, 'name');
    if ($name == NULL || $name == FALSE) {
        $error = "Invalid user name";
        include('../errors/error.php');
        exit();  // we're done with this response
    }
    try {
        delete_user($db, $name);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();  // needed here to avoid redirection of next line
    }
    // Redirect back to index.php (see pp. 164-165)
    // (don't try to include index.php inside index.php)
    header("Location: .");
}
