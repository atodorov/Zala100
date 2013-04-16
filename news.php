<?php
define("LAYOUT","news");
require_once("init.php");
require_once("sidebar.php");
$smarty->assign("title","Новини");
$result = $db->query("SELECT COUNT(*) as cnt FROM `news` WHERE `isNews` = 1");
$num = $result->fetch_array(MYSQLI_ASSOC);
$num = $num['cnt'];
$books_per_page = 5;
$all_pages = ceil($num/$books_per_page);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page-1)*$books_per_page;
$sql = "SELECT * FROM `news` WHERE `isNews` = 1 ";

$sql .="  LIMIT ".$start.", ".$books_per_page;

$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $array[] = $row;
}
$smarty->assign("a",4);
$smarty->assign("script","news");
$smarty->assign("news",$array);
$smarty->assign("page",$page);
$smarty->assign("all_pages",$all_pages);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");

?>
