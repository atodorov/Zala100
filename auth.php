<?php
define("LAYOUT","auth");
require_once("init.php");
$smarty->assign("title","Auth");
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
?>
