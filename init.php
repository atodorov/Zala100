<?php
@session_start();
// Template Engine
define("TEMPLATE_DIR","templates");
define("ROOT_PATH","/home/zala100o/public_html/");
require_once('libs/smarty/Smarty.class.php');
$smarty = Smarty::get_instance();
$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->compile_dir = 'cache/smarty/';
if(isset($_SESSION['100p_user']))
{
	$smarty->assign("UserLogedIn",true);
	$smarty->assign("UserID",$_SESSION['100p_user']['UserID']);
	$smarty->assign("UserFirstName", $_SESSION['100p_user']['First_Name']);
}
else
{
	$smarty->assign("UserLogedIn", false);
}
$db = new mysqli("localhost","zala100o_100p","100p_secret","zala100o_100p");
if ($db->connect_errno) 
{
    die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
}
$db->query("SET NAMES 'utf8'");
?>