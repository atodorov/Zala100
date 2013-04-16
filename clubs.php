<?php
define("LAYOUT","clubs");
require_once("init.php");
require_once("sidebar.php");
$script = "clubs";
$smarty->assign("title","Clubs");
$result = $db->query("SELECT COUNT(*) AS cnt FROM `clubs`");
$num = $result->fetch_array(MYSQLI_ASSOC);
$num = $num['cnt'];
$clubs_per_page = 10;
$all_pages = ceil($num/$clubs_per_page);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page-1)*$clubs_per_page;
// sql query for clubs data
$sql = "SELECT *,
			(SELECT COUNT(*) FROM `club_members` WHERE `club_members`.club_id=`clubs`.id) AS MembersCount,
			(SELECT  CONCAT(first_name, ' ', last_name) AS AdminName FROM `users`
			INNER JOIN `club_members` on `users`.id = `club_members`.User_Id
			WHERE `club_members`.Is_Admin = 1 AND `clubs`.id = `club_members`.Club_Id
			LIMIT 1) AS ClubAdmin
		FROM `clubs`";

$sql .="  LIMIT ".$start.", ".$clubs_per_page;

$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$clubs[] = $row;
}
// end sql query for clubs data

$smarty->assign("a",3);
$smarty->assign("clubs",$clubs);
$smarty->assign("page",$page);
$smarty->assign("all_pages",$all_pages);
$smarty->assign("script",$script);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");

?>