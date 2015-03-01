<!DOCTYPE html>
<html>
<head>
	<title>I Heart Paint</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/ntc.js"></script>

	<script type="text/javascript">
<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"hackdfw@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		if(!is_resource($connection)){ echo 'Could not connect: '; print_r(sqlsrv_errors(SQLSRV_ERR_ALL)); }
		$query = "SELECT id,color FROM Colors";
		$result = sqlsrv_query($connection, $query);
?>
	</script>

	<style>
		.color-square{
			height: 200px;
			width: 100%;
			border-radius: 10px;
			box-shadow: 2px 2px 3px rgb(165, 165, 165);
		}
		.color-square:hover{
			box-shadow: 0px 0px 10px rgb(0, 0, 0);
		}
		.color-name{
			text-align: center;
		}
		.delete{
			float: right;
		}
		.btn{
			font-size: 20px;
		}
		.color{
			margin-bottom: 20px;
		}
		.navbar{
			box-shadow: 2px 2px 3px rgb(165, 165, 165);
		}
	</style>

</head>
<body>

	<div class="container" style="padding-top: 40px;">

		<nav class="navbar navbar-inverse">

			<div class="container">

			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">I Heart Paint</a>
			    </div>

			</div>

		</nav>

		<div class="row color-list">
<?php
			if( $result === false) {
					print_r( sqlsrv_errors(SQLSRV_ERR_ALL));
			}
			else
			{
				while($array = sqlsrv_fetch_array($result))
				{
?>
					<script type="text/javascript">
					var color = ntc.name("#<? echo $array[1]; ?>");
					$(".color-list").append("<div class='col-md-4 color'><div class='color-square' style='background-color:" + color[0] + "'></div><h3 class='color-name'>" + color[1] + "</h3> <div class='row'><div class='col-md-6'><div class='order btn btn-default'>Order</div></div><div class='col-md-6'><div onmouseup='window.location.href='delete.php/?id=<? echo $array[1]; ?>'' class='delete btn btn-default'>Delete</div></div></div></div>");
					</script>
<?php
				}
			}
?>
		</div>	

	</div>

</body>

</html>