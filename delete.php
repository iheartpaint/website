<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"hackdfw@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		if(!is_resource($connection)){ echo 'Could not connect: '; print_r(sqlsrv_errors(SQLSRV_ERR_ALL)); }
		$query = "DELETE FROM Colors WHERE (id = $_GET['id'])";
		$result = sqlsrv_query($connection, $query);
		//header('Location: http://iheartpaint.azurewebsites.net/');
?>