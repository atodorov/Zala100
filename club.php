<?php
define("LAYOUT","club");
require_once("init.php");
require_once("sidebar.php");

$id = (int)trim($_GET['id']);

$sql = "SELECT *,
			(SELECT COUNT(*) FROM `club_members` WHERE `club_members`.club_id=`clubs`.id) AS MembersCount,
			(SELECT  CONCAT(first_name, ' ', last_name) AS AdminName FROM `users`
			INNER JOIN `club_members` on `users`.id = `club_members`.User_Id
			WHERE `club_members`.Is_Admin = 1 AND `clubs`.id = `club_members`.Club_Id
			LIMIT 1) AS ClubAdmin
		FROM `clubs`
		WHERE `clubs`.id = " .$id;
$result = $db->query($sql);
$club = $result->fetch_array(MYSQLI_ASSOC);


$sql = "SELECT `users`.First_Name, `users`.Last_Name 
		FROM `users`
		INNER JOIN `club_members` on `users`.id = `club_members`.User_Id
		WHERE `club_members`.Club_Id = " .$id;
$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$members[] = $row;
}
$sql = "SELECT `news`.*
		FROM `news`
		INNER JOIN `club_news` on `club_news`.News_Id = `news`.id
		WHERE `news`.isNews = 0 AND `club_news`.Club_Id = " .$id;
$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$news[] = $row;
}
$smarty->assign("a",3);
$smarty->assign("title","Club ".htmlspecialchars($club['Name']));
$smarty->assign("club",$club);
$smarty->assign("members",$members);
$smarty->assign("news",$news);


$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");


?>