<?php
// user_db.php: DB access for topping data
// the try/catch for these actions is in the caller, index.php
function add_user($db, $name,$roomnum)  
{
	$query='INSERT INTO shop_users (username,room) VALUES (:name,:roomnum)';
	$statement=$db->prepare($query);
	$statement->bindValue(':name',$name);
	$statement->bindValue(':roomnum',$roomnum);
	$statement->execute();
	$statement->closeCursor();
}

function get_users($db) {
    $query = 'SELECT * FROM shop_users';
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    return $users;    
}

function delete_user($db, $name){

	$query='DELETE FROM shop_users WHERE username=:name';
	$statement=$db->prepare($query);
	$statement->bindValue(':name',$name);
	$statement->execute();
	$statement->closeCursor();
}
