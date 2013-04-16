<?php
define("LAYOUT","book");
require_once("init.php");
require_once("sidebar.php");
$id = (int)trim($_GET['id']);
$result  = $db->query("SELECT b.*, b.rating/b.rated as realRating, c.`Name` as Cat_Name, l.`Name` as Lang  FROM `books` as b JOIN `categories` as c ON c.`id`=b.`Category_Id` JOIN `languages` as l ON l.`id` = b.`Language_Id` WHERE b.`id` = ".$id);
$book = $result->fetch_array(MYSQLI_ASSOC);
if(isset($_POST['submit']))
{
	if($_POST['captcha'] == $_SESSION['rand_code'])
	{
		$sql = "INSERT INTO `book_comments` (`Book_id`, `Comment_Text`, `User_Id`) VALUES (?,?,?)";
		$stmt = $db->prepare($sql);
		$stmt->bind_param("isi",$id,$_POST['comment'],$_SESSION['100p_user']['UserID']);
		$stmt->execute();
		if($stmt->affected_rows)
		{
			$smarty->assign("message","Успешно добавихте коментар");
		}
		else
		{
			$smarty->assign("message", "Не успяхме да добавим вашият коментар");
		}
	}
	else
	{
		$smarty->assign("message","Грешен код от картинката!");
	}
}
$sql = "SELECT bc.`Comment_Text`, bc.`Time` , u.`First_Name`, u.`Last_Name` FROM `book_comments` as bc JOIN `users` as u ON bc.`User_Id` = u.`id` WHERE bc.`Book_Id` = ".$book['id'];
$cmts = ($_GET['cmts']) ? $_GET['cmts']: 'new' ;
if($cmts != "all")
{
	$sql .= " LIMIT 5";
}

$result = $db->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$comments[] = $row;
}
$smarty->assign("a",2);
$smarty->assign("title","Book ".htmlspecialchars($book['Name']));
$smarty->assign("book",$book);
$smarty->assign("comments",$comments);
$smarty->assign("cmts",$cmts);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
?>
