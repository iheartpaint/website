<!DOCTYPE html>
<html>
<head>
	<title>I Heart Paint</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/ntc.js"></script>

	<script>
<?php
		$connectionInfo = array("Database"=>"iheartpaint", "UID"=>"iheartpaint@hackdfw", "PWD"=>"ilike2butts!");
		$connection = sqlsrv_connect('hackdfw.database.windows.net', $connectionInfo);
		$query = "SELECT * FROM colors";
		$result = sqlsrv_query($connection, $query);
		if (sqlsrv_num_rows($result) > 0)
		{
			while($array = sqlsrv_fetch_array($result))
			{
				echo "poop";
?>
				function addColor(hexVal)
				{
					var color = ntc.name(hexVal);
					$(".color-list").append("<div class='col-md-4 color'><div class='color-square' style='background-color:" + color[0] + "'></div><h3 class='color-name'>"+ color[1]+"</h3> <div class='row'><div class='col-md-6'><div class='order btn btn-default'>Order</div></div><div class='col-md-6'><div class='delete btn btn-default'>Delete</div></div></div></div>");
				}
<?php
			}
		}
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

		</div>	

	</div>

</body>

</html>