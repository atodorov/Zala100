<?php
require_once("../init.php");
if(!isset($_POST['uid']) || !isset($_POST['bid']) || !isset($_POST['rating']))
{
	die('Error : Wrong data');
}
$sql = "SELECT `id` FROM `rating` WHERE `User_Id` = ? AND `Book_Id` = ? LIMIT 1";
$select_stmt = $db->prepare($sql);
$select_stmt->bind_param("ii",$_POST['uid'],$_POST['bid']);
$select_stmt->execute();
$select_stmt->store_result();
if($select_stmt->num_rows)
{
	$select_stmt->close();
	die('Allready rated this one');
}
$select_stmt->close();

$sql = "INSERT INTO `rating` (`User_Id`, `Book_Id` , `Rated`) VALUES (?,?,?)";
$stmt = $db->prepare($sql);
$stmt->bind_param("iii",$_POST['uid'],$_POST['bid'],$_POST['rating']);
$stmt->execute();
if($stmt->affected_rows)
{
	$stmt->close();
	$sql= "UPDATE `books` SET `rated`= `rated`+1 , `rating`= `rating`+? WHERE `id` = ? ";
	$stmt = $db->prepare($sql);
	$stmt->bind_param("ii",$_POST['rating'],$_POST['bid']);
	$stmt->execute();
	if($stmt->affected_rows)
	{
		die("OK");
	}
	else
	{
		die("ERR2");
	}
}
else
{
	die("ERR1");
}

?>