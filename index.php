<?php
define("LAYOUT","index");
require_once("init.php");
require_once("sidebar.php");
$smarty->assign("title","БЛАГО");
$smarty->assign("a",1);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
?>
