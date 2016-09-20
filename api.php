<?php
	require_once "admin/db.php";

	// $db_host = "mysql.hostinger.pl";
	// $db_login = "u752437636_hunt";
	// $db_pass = "huntapp1";
	// $db_name = "u752437636_hunt";

	$dbconnect = new mysqli($db_host, $db_login, $db_pass, $db_name);

	if ($dbconnect->connect_errno!=0)
	{
		echo "Error: ".$dbconnect->connect_errno;
	}
	else
	{
		$sql = "SELECT * FROM workers";
		$query = $dbconnect->query($sql);

		if(mysqli_num_rows($query))
		{
			$workers = array();
			$i = 0;
			while($row=mysqli_fetch_assoc($query))
			{
				$workers[workers][$i] = $row;
				$i++;
			}
		} 
		echo json_encode($workers);
	}