<?php
function getClubNews()
{
	$current_session_user_id = $_SESSION['id'];
	$sql = "SELECT news.Title, news.Text, news.Time
			FROM news 
			JOIN club_news ON news.id = club_news.News_Id
			JOIN clubs ON club_news.Club_Id = clubs.id
			JOIN club_members ON clubs.id = club_Members.Club_Id
			WHERE club_members.User_Id = '".$current_session_id."' 
			ORDER BY Time desc";
	mysql_query($sql);
}

function relevantToUser()
{
//(SELECT COUNT(*) FROM club_news cn where cn.News_ID = n.id) = 0
	$sql = "'".getClubNews()."' UNION 
			SELECT news.Title, news.Text, news.Time
			FROM news n
			where n.id NOT IN (SELECT `News_ID` FROM `club_cews` WHERE 1 ) 
			ORDER BY Time desc";
	mysql_query($sql);
}

function getAllNews()
{
	$current_session_user_id = $_SESSION['id'];
	$sql = "SELECT COUNT(*) FROM users 
			JOIN roles ON users.Role_Id = roles.id
			where users.id = '".$current_session_user_id."' 
			AND roles.Name = 'Site Admin'"; //probably the worst way to check if 
											//you are logged in as admin
											//I'm currently asleep
	
	$result = mysql_query($sql);
	if($re
}