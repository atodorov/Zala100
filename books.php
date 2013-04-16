<?php
define("LAYOUT","books");
require_once("init.php");
require_once("sidebar.php");
$smarty->assign("title","Books");
$result = $db->query("SELECT COUNT(*) as cnt FROM `books`");
$num = $result->fetch_array(MYSQLI_ASSOC);
$num = $num['cnt'];
$books_per_page = 10;
$all_pages = ceil($num/$books_per_page);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$by = (isset($_GET['by'])) ? $_GET['by'] : 'date';
$start = ($page-1)*$books_per_page;
$sql = "SELECT *, rating/rated as realRating FROM `books` ";
if ($by == "available")
	$sql .=" WHERE `Taken_By_User_Id` IS NULL  ";
else
{
	$sql .=" ORDER BY"; 
	if($by == "date")
    	$sql .=" `id` ";
	else if ($by == "rating")
    	$sql .=" realRating ";
    $sql .= " DESC ";
}
$sql .="  LIMIT ".$start.", ".$books_per_page;

$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $books[] = $row;
}
$smarty->assign("a",2);
$smarty->assign("script","books");
$smarty->assign("by",$by);
$smarty->assign("books",$books);
$smarty->assign("page",$page);
$smarty->assign("all_pages",$all_pages);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");

?>
