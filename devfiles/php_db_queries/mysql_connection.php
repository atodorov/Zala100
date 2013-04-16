<?php
// Used for update/insert
function alterQuery($sql_query) {
	$con=mysqli_connect("127.0.0.1:3306","root","","100p");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if (!mysqli_query($con, $sql_query))
	{
		die('Error: ' . mysqli_error($con));
	}
	mysqli_close($con);
}
// Used for select
function getQuery($sql_query) {
	$array = array();
	$con=mysqli_connect("127.0.0.1:3306","root","","100p");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($con, $sql_query);
	$i=0;
	if (!$result) {
		die("Error: " . mysqli_error($con));
	}
	while($row = mysqli_fetch_array($result))
	{
		$array[$i] = $row;
		$i++;
	}

	mysqli_close($con);
	return $array;
}
?>