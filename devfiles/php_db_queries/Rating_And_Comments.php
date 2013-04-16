<?php
function getAvgRating($book_selected_id)
{
	$sql = "SELECT books.Name, avg(rating.Rated) AS Average_Rating
			FROM rating JOIN books ON rating.Book_ID = books.id
			WHERE books.id = '".$book_selected_id."' ";
	mysql_query($sql);
}

function rate($book_selected_id, $rating_feedback)
{
	$current_session_user_id = $_SESSION['id'];
	$sql = "SELECT * 
			FROM rating
			WHERE User_ID = '".$current_session_id."' ";
	$result = mysql_query($sql);
	if(!isset($result))
	{
		$sql = "INSERT INTO rating(User_ID,Book_ID,Rated)
				VALUES('".$current_session_user_id."', '".$book_selected_id."', '".$rating_feedback."')";
		mysql_query($sql);
	}
}

function insertComment($book_id, $comment)
{
	$current_session_user_id = $_SESSION['id'];
	$sql = "INSERT INTO book_comments(Book_Id,Comment_Text,User_Id,Time)
			VALUES('".$book_selected_id.", '".$comment.", '".$current_session_user_id.", curtime())";
	mysql_query($sql);
}

function getAllComments($book_id)
{
	$sql = "SELECT Comment_Text, First_Name, Last_Name, Time
			FROM book_comments JOIN Users ON book_comments.User_Id = users.id
			where book_comments.Book_Id = '".$book_id."' ";
	mysql_query($sql);
}

function editComment($comment_id, $new_text)
{
	$sql = "UPDATE book_comments
			SET comment_text = '".$new_text."', Time = curtime()
			WHERE id = '".$comment_id."'";
	mysql_query($sql);
}

function addLanguage($lang_name)
{
	$sql = "SELECT *
			FROM languages
			where Name = '".$lang_name."'";
	$result = mysql_query($sql);
	if(!isset($result))
	{
		$sql = "INSERT INTO languages(Name)
				VALUES('".$lang_name."')";
		mysql_query($sql);
	}
}

?>