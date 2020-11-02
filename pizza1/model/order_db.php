<?php

function newpizza($db,$id,$current_day,$size,$usertoppings){

	$query1='insert into pizza_orders(user_id,day,size,status) values (:id,:current_day,:size,"Preparing")';
	$statement=$db->prepare($query1);
	$statement->bindValue(':id',$id);
	$statement->bindValue(':current_day',$current_day);
	$statement->bindValue(':size',$size);
	$statement->execute();

	$query2='select max(id) as id from pizza_orders';
	$statement=$db->prepare($query2);
	$statement->execute();
	$pid=$statement->fetch();
	$statement->closeCursor();

	foreach($usertoppings as $topping){
		$query3='insert into order_topping(order_id,topping) values (:pid,:topping)';
		$statement=$db->prepare($query3);
		$statement->bindValue(':pid',$pid['id']);
		$statement->bindValue(':topping',$topping);
		$statement->execute();
		$statement->closeCursor();
	}
}
function getbaked($db){
	$query='select p.user_id as id,s.username as name
		from pizza_orders as p,shop_users as s
		where p.status=\'Baked\' and p.user_id=s.id';
	$statement=$db->prepare($query);
	$statement->execute();
	$bakeds=$statement->fetchAll();
	return $bakeds;
}
function getprep($db){
	$query='select p.user_id as id,s.username as name
		from pizza_orders as p,shop_users as s
		where p.status=\'Preparing\' and p.user_id=s.id';
	$statement=$db->prepare($query);
	$statement->execute();
	$preps=$statement->fetchAll();
	return $preps;
}
function bake($db){

	$query1='select min(id) as min
		from pizza_orders
		where status=\'Preparing\'';
	$statement=$db->prepare($query1);
	$statement->execute();
	$min=$statement->fetch();
	$statement->closeCursor();

	$query2='update pizza_orders
		set status=\'Baked\'
		where id=:min';
	$statement=$db->prepare($query2);
	$statement->bindValue(':min',$min['min']);
	$statement->execute();
	$statement->closeCursor();

}

function usrbaked($db,$id)
{
	$query='select id,size,status
		from pizza_orders
		where user_id=:id
		and status=\'Baked\'';
	$statement=$db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->execute();
	$bakeds=$statement->fetchAll();
	$statement->closeCursor();
	return $bakeds;

}
function usrprep($db,$id)
{
	$query='select id,size,status
		from pizza_orders
		where user_id=:id
		and status=\'Preparing\'';
	$statement=$db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->execute();
	$preps=$statement->fetchAll();
	$statement->closeCursor();
	return $preps;
}
function usrtopps($db)
{
	$query='select * from order_topping';
	$statement=$db->prepare($query);
	$statement->execute();
	$usrtopps=$statement->fetchAll();
	$statement->closeCursor();
	return $usrtopps;
}
function fin($db,$pid,$id){


	$query1='update pizza_orders
		set status=\'Finished\'
		where id=:pid';
	$statement=$db->prepare($query1);
	$statement->bindValue(':pid',$pid);
	$statement->execute();
	$statement->closeCursor();

	$query='select id,size,status
		from pizza_orders
		where user_id=:id
		and status=\'Baked\'';
	$statement=$db->prepare($query);
	$statement->bindValue(':id',$id);
	$statement->execute();
	$bakeds=$statement->fetchAll();
	$statement->closeCursor();
	return $bakeds;

}
