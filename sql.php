<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"iheartpaint@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		$query = $_GET['query'];
		var_dump($query);
		$result = sqlsrv_query($connection, $query);
		echo $result;
		var_dump(sqlsrv_errors(SQLSRV_ERR_ALL));
?>