<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"iheartpaint@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		$query = $_GET['query'];
		$result = sqlsrv_query($connection, $query);
		var_dump($result);
		var_dump(sqlsrv_errors(SQLSRV_ERR_ALL));
?>