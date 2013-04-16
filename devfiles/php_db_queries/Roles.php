<?php
require 'mysql_connectio.php';

// Get all roles
function getRoles() {
	return getQuery("SELECT * FROM roles");
}
// Get Role by id
function getRoleById($id) {
	return getQuery("SELECT * FROM roles WHERE id=" . $id . "");
}
// Add role with given Name
function addRole($name) {
	alterQuery("INSERT INTO roles (Name) VALUES('" . $name . "')");
}
// Update role by id
function updateRoleById($id, $name) {
	alterQuery("UPDATE roles SET Name='". $name . "' WHERE id=" . $id);
}
// Delete role by id
function deleteRoleById($id) {
	alterQuery("DELETE FROM roles WHERE id=" . $id);
}
?>