<?php

function getday($db){

	$query='SELECT current_day FROM pizza_sys_tab';
	$statement=$db->prepare($query);
	$statement->execute();
	$current_day=$statement->fetch();
	$day=$current_day['current_day'];
	$statement->closeCursor();

	return $day;
}

function getorders($db,$current_day){

	$query='SELECT pizza_orders.id as id,username,status FROM pizza_orders,shop_users WHERE pizza_orders.day=:current_day AND pizza_orders.user_id=shop_users.id';
	$statement=$db->prepare($query);
	$statement->bindValue(':current_day',$current_day);
	$statement->execute();
	$orders=$statement->fetchAll();
	$statement->closeCursor();

	return $orders;

}

function inc($db,$current_day){
	$query1='update pizza_sys_tab 
		set current_day=:current_day';
	$statement=$db->prepare($query1);
	$statement->bindValue(':current_day',$current_day+1);
	$statement->execute();
	$statement->closeCursor();

	$query='update pizza_orders
		set status=\'Finished\'';
	$statement=$db->prepare($query);
	$statement->execute();
	$statement->closeCursor();

}

