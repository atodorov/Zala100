<?php
	require_once("init.php");
	if(isset($_GET['id']))
	{
		$a = 4;
		$id = trim($_GET['id']);
		$id = (int)$id;
		$sql = "SELECT * FROM `news` WHERE `id` = ".$id;
		if($id==2)
			$a = 6;
		if($id==8)
			$a = 5;
		$result = $db->query($sql);
		if($result->num_rows)
		{
			while($row = $result->fetch_array(MYSQLI_ASSOC))
			{
				$array[] = $row;
			}
			$smarty->assign("news",$array);
			define("LAYOUT","articles");
		}
		else
		{
			define("LAYOUT","404");
		}
	}
	else
	{
		define("LAYOUT","404");
	}
$smarty->assign("a",$a);
$smarty->display(ROOT_PATH.DIRECTORY_SEPARATOR.TEMPLATE_DIR.DIRECTORY_SEPARATOR.LAYOUT.".html");
?>