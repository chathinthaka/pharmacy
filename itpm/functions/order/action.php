<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO order (customer_name, product_name, quantity, unit_price, status) VALUES ('".$_POST["customer_name"]."', '".$_POST["product_name"]."', '".$_POST["quantity"]."', '".$_POST["unit_price"]."', '".$_POST["status"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM order WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['customer_name'] = $row['customer_name'];
			$output['product_name'] = $row['product_name'];
			$output['quantity'] = $row['quantity'];
			$output['unit_price'] = $row['unit_price'];
			$output['status'] = $row['status'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE order 
		SET customer_name = '".$_POST["customer_name"]."', 
		product_name = '".$_POST["product_name"]."',
		quantity = '".$_POST["quantity"]."',
		unit_price = '".$_POST["unit_price"]."',
		status = '".$_POST["status"]."' 
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM order WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>