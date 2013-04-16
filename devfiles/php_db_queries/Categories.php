<?php
require 'mysql_connection.php';

// Get all Categories
function getCategories() {
	return getQuery("SELECT * FROM categories");
}
// Get Category by id
function getCategoryById($id) {
	return getQuery("SELECT * FROM categories WHERE id=" . $id . "");
}
// Add Category with given Name
function addCategory($name) {
	alterQuery("INSERT INTO categories (Name) VALUES('" . $name . "')");
}
// Update Category by id
function updateCategoryById($id, $name) {
	alterQuery("UPDATE categories SET Name='". $name . "' WHERE id=" . $id);
}
// Delete Category by id
function deleteCategory($id) {
	alterQuery("DELETE FROM categories WHERE id=" . $id);
}
?>