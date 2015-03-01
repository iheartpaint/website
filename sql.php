<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"iheartpaint@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		$query = $_GET;
		$result = sqlsrv_query($connection, $query);
?>