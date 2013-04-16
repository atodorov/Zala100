<?php
require_once('init.php');
if(isset($_POST['email']) && isset($_POST['passwd']))
{
	$sql = "SELECT u.`id`,u.`First_Name`,u.`Last_Name`, u.`Role_Id` FROM users as u WHERE u.`email` = ? AND u.`password` = md5(?)";
	$statement = $db->prepare($sql);
	$statement->bind_param("ss",$_POST['email'],$_POST['passwd']);
	$statement->execute();
	$statement->store_result();
	$statement->bind_result($row['id'],$row['First_Name'],$row['Last_Name'],$row['Role_Id']);
	$statement->fetch();
 	if($statement->num_rows)
 	{
		$_SESSION['100p_user']['UserID'] = $row['id'];
		$_SESSION['100p_user']['First_Name'] = $row['First_Name'];
		$_SESSION['100p_user']['Last_Name'] = $row['Last_Name'];	
		$_SESSION['100p_user']['Role_Id'] = $row['Role_Id'];
		echo '<meta http-equiv="refresh" content="2;url=http://thesmokersroom.com/" />';
		echo '<h1>Благо, къде е Благо?</h1>';
	}
	else
	{
		define("LAYOUT","auth");
		$smarty->assign("error","Грешни входни данни!");
		$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
	}
}
else
{
	echo '<meta http-equiv="refresh" content="0;url=http://thesmokersroom.com/auth.php" />';
}
?>