<?php

//action.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{
		$query = "
		INSERT INTO customer (customer_name, customer_number, password, status) VALUES ('".$_POST["customer_name"]."', '".$_POST["customer_number"]."', '".$_POST["password"]."', '".$_POST["status"]."')
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Inserted...</p>';
	}
	if($_POST["action"] == "fetch_single")
	{
		$query = "
		SELECT * FROM customer WHERE id = '".$_POST["id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['customer_name'] = $row['customer_name'];
			$output['customer_number'] = $row['customer_number'];
			$output['password'] = $row['password'];
			$output['status'] = $row['status'];
		}
		echo json_encode($output);
	}
	if($_POST["action"] == "update")
	{
		$query = "
		UPDATE customer 
		SET customer_name = '".$_POST["customer_name"]."', 
		customer_number = '".$_POST["customer_number"]."',
		password = '".$_POST["password"]."',
		status = '".$_POST["status"]."' 
		WHERE id = '".$_POST["hidden_id"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Updated</p>';
	}
	if($_POST["action"] == "delete")
	{
		$query = "DELETE FROM customer WHERE id = '".$_POST["id"]."'";
		$statement = $connect->prepare($query);
		$statement->execute();
		echo '<p>Data Deleted</p>';
	}
}

?>