<?php
require 'mysql_connection.php';

// Get all books
function getBooks() {
	return getQuery("SELECT * FROM books");
}
// Get book with filter
function getBookWithFilter($id=null, $name=null, $author=null, $yop=null, $tbu_id=null, $category_id=null, $language_id=null) {
	$sql_where_query = "";
	if(!empty($id)) {
		$sql_where_query .= "id=" . $id; 
	}
	if(!empty($name)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Name LIKE '%" . $name . "%'";
	}
	if(!empty($author)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Author LIKE '%" . $author . "%'";
	}
	if(!empty($yop)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Year_Of_Publish=" . $yop; 
	}
	if(!empty($tbu_id)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Taken_By_User_Id=" . $tbu_id;
	}
	if(!empty($category_id)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Category_Id=" . $category_id; 
	}
	if(!empty($language_id)) {
		if(!empty($sql_where_query)) {
			$sql_where_query .= " AND";
		}
		$sql_where_query .= " Language_Id=" . $language_id;
	}
	
	return getQuery("SELECT * FROM books WHERE " . $sql_where_query);
}
// Add book with given Name, Author, Year of Publish, Taken By User, Category, Language
function addBook($name, $author, $yop, $category_id, $language_id, $tbu_id=null) {
	if(empty($tbu_id)) {
		$tbu_id = "null";
	}
	alterQuery("INSERT INTO books (Name, Author, Year_Of_Publish, Taken_By_User_Id, Category_Id, Language_Id) 
							VALUES('" . $name . "','" . $author . "', " . $yop . ", " . $tbu_id . ", " . $category_id . " , " . $language_id . ")");
}
// Update book by id with given Name, Author, Year of Publish, Taken By User, Category, Language
function updateBookById($id, $name, $author, $yop, $category_id, $language_id, $tbu_id=null) {
	if(empty($tbu_id)) {
		$tbu_id = "null";
	}
	alterQuery("UPDATE books 
					SET 
						Name='" . $name . "',
						Author='" . $author . "',
						Year_Of_Publish=" . $yop . ",
						Taken_By_User_Id=" . $tbu_id . ",
						Category_Id=" . $category_id . ",
						Language_Id=" . $language_id . "
					WHERE id=" . $id);
}

// Delete book by id
function deleteBookById($id) {
	alterQuery("DELETE FROM book_comments WHERE Book_Id=" . $id);
	alterQuery("DELETE FROM rating WHERE Book_Id=" . $id);
	alterQuery("DELETE FROM books WHERE id=" . $id);
}
?>