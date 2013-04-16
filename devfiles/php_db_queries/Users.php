<?php
require 'mysql_connection.php';

// Get all users
function getUsers() {
	return getQuery("SELECT * FROM users");
}
// Get user with filter
function getUserWithFilter($id, $first_name, $last_name, $role_id, $fn, $email) {
	$sql_where_query = "";
	if(!empty($id)) {
		$sql_where_query .= "id=" . $id; 
	}
	if(!empty($first_name)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " First_Name LIKE '%" . $first_name . "%'";
	}
	if(!empty($last_name)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Last_Name LIKE '%" . $last_name . "%'";
	}
	if(!empty($role_id)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Role_Id=" . $role_id; 
	}
	if(!empty($fn)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " FN=" . $fn;
	}
	if(!empty($email)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " email='" . $email . "'";
	}
	
	return getQuery("SELECT * FROM users WHERE " . $sql_where_query);
}
?>