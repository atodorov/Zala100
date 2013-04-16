<?php
require_once ('init.php');
if(!isset($_SESSION['100p_user']))
{
	$LAYOUT="register_form";
	include('functions.php');

	if (isset($_POST['submit'])) 
	{
		$LAYOUT="register_info";
		$res = registration($_POST['fname'], $_POST['lname'], $_POST['passwd'], $_POST['fn'], $_POST['email']);	
		if ($res == true) 
		{
			$smarty->assign("successful","Успешно се регистрирахте!");
		} 
		else 
		{
			$LAYOUT="register_form";
			$smarty->assign("error", "Този потребител е вече регистриран.");
		}
	}
	else
	{
	   $smarty->assign("title","Регистрация");
	}
	$smarty->assign("title","Регистрация");
}
else
{
	$LAYOUT="register_info";
	$smarty->assign("successful","Вече сте регистриран!");
}
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.$LAYOUT.".html");
?>