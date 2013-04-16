<?php

	function returnToArray ($sql) {
		global $db;
		$array = array();
		
		while ($rows = mysql_fetch_array($sql)) {
			$array[] = $rows;	
		}
		return $array;
	}
	
	// Register Users 
	function registration($fName, $lName, $passwd, $fn, $email) 
	{
		global $db;	
		$res = checkUsers($email, $fn);

		if($res != true)
		{
			$sql = "INSERT INTO `users` (First_Name, Last_Name, FN, email, password)
								 VALUES (?,?,?,?, md5(?))";
			$stmt = $db->prepare($sql);
			$stmt->bind_param("ssiss",$_POST['fname'],$_POST['lname'],$_POST['fn'],$_POST['email'],$_POST['passwd']);
			$stmt->execute();
			if($stmt->affected_rows)
				return true;
			else
				return false;
		}
	}
	
	// Chech users exists
	function checkUsers($email, $fn) 
	{
		global $db;
		$sql = "SELECT `id` FROM users WHERE email = ? AND FN = ? LIMIT 1";
		$statement = $db->prepare($sql);
		$statement->bind_param("si",$email,$fn);
		$statement->execute();
		$statement->store_result();
		if($statement->num_rows) 
		{
			$statement->close();
			return true;
		} 
		else 
		{
			$statement->close();
			return false;
		}
	}
	
	// Set Password 
	function setPassword($passwd, $email) 
	{
		$sql = "UPDATE `users` SET `password` = '".$passwd."' WHERE email = '".$email."'";	
		mysql_query($sql);
	}
	
	// Chech user logged
	function checkUser() {
		if(!isset($_SESSION['100p_user']))	
		{
			header("Location: auth.php");	
		}
	}
?>