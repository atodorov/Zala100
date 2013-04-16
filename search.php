<?php
define("LAYOUT","books");
require_once("init.php");
require_once("sidebar.php");
$smarty->assign("title","Търсене...");
if(isset($_POST['query']))
{
	$search_query = '%'.trim($_POST['query']).'%';
	$normal_query = trim($_POST['query']);
}
else if(isset($_GET['q']))
{
	$search_query = '%'.trim(urldecode($_GET['q'])).'%';
	$normal_query = trim(urldecode($_GET['q']));
}
else
{
	echo 'Грешно търсене!';
	exit();
}
$stmt = $db->prepare("SELECT COUNT(*) as cnt FROM `books` WHERE `Name` LIKE ? OR `Author` LIKE ? ");
$stmt->bind_param("ss",$search_query,$search_query);
$stmt->execute();
$stmt->bind_result($num);
$stmt->fetch();
$stmt->close();
$books_per_page = 10;
if($num != 0)
{
	$all_pages = ceil($num/$books_per_page);
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page-1)*$books_per_page;
	$sql = "SELECT Name, Author, rating/rated as realRating, id, image FROM `books` WHERE `Name` LIKE ? OR `Author` LIKE ?  ";

	$sql .="  LIMIT ".$start.", ".$books_per_page;
	$stmt = $db->prepare($sql);
	$stmt->bind_param("ss",$search_query,$search_query);
	$stmt->execute();
	$stmt->bind_result($b_Name, $b_Author, $b_realRating, $b_id, $b_image);
	$i =0;
	while($stmt->fetch())
	{
		$books[$i]['Name']=$b_Name;
		$books[$i]['Author']=$b_Author;
		$books[$i]['realRating']=floatval($b_realRating);
		$books[$i]['id']=$b_id;
		$books[$i]['image']=$b_image;
		$i++;
	}
	$stmt->close();
	$smarty->assign("message","Намерихме ".$num." книги отговарящи на ".$normal_query);
	$smarty->assign("query",urlencode($normal_query));
	$smarty->assign("books",$books);
	$smarty->assign("page",$page);
	$smarty->assign("all_pages",$all_pages);
}
else
{
	$smarty->assign("message","Няма намерени резултати за ".$normal_query."!");
}
$smarty->assign("a",2);
$smarty->assign("script","search");
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");

?>
