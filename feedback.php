<?php
require_once("init.php");
require_once("sidebar.php");
if(isset($_POST['send']))
{
	define("LAYOUT","feedback_send");
	
}
else
{
	define("LAYOUT","feedback_form");

}
$smarty->assign("a",1);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
?>