<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		body{
			background-color: #f3f3f3;
		}
		.comUpdateform {
			width: 360px;
  			padding: 5% 0 0;
  			margin: auto;
			
		}
		.form {
			position: relative;
  			z-index: 1;
  			background: #FFFFFF;
  			max-width: 360px;
  			margin: 0;
  			padding: 36px;
  			text-align: center;
  			box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
		}
		.form input.textfiled {
			outline: 0;
  			background: #f2f2f2;
  			width: 100%;
  			border: 0;
  			margin: 0 0 15px;
  			padding: 15px;
  			box-sizing: border-box;
  			font-size: 14px;
		}
		.form input.button {
			outline: 0;
  			background: #f2f2f2;
  			width: 100%;
  			border: 0;
  			margin: 0 0 15px;
  			padding: 15px;
  			box-sizing: border-box;
  			font-size: 14px;
  			cursor:pointer;
		}
		p {
			font-size: 14px;
			margin: 0 0 10px;
		}
		</style>
	</head>

	<body>
	<?php
	session_start();
				$cid = $_SESSION['cid'];
				$cname = $_SESSION['cname'];
				include ('conn.php');
				$gethead = mysqli_query($conn, "select headquarter from Company where cid = $cid");
				$headquarter = mysqli_fetch_row($gethead)[0];
				$getind = mysqli_query($conn, "select industry from Company where cid = $cid");
				$industry = mysqli_fetch_row($getind)[0];

print<<<EOT
	<div class = "comUpdateform">
		<div class="form">
			<div>
			<form action = "comUpdatecheck.php" method = "POST">
				<table border = 0>
				<p><tr><td><h3>Profile </h3></td></tr></p><p>
				<tr><td>Company Name:</td>
				<td><input class="textfiled" type = "text" placeholder="$cname" name = "cname"></td></tr>
				<tr><td>Headquarter: </td>
				<td><input class="textfiled" type = "text" placeholder="$headquarter" name = "headquarter"></td></tr>
				<tr><td>Industry: </td>
				<td><input class="textfiled" type = "text" placeholder="$industry" name = "industry"></td></tr>
				</table>
			<input class="button" type = "submit" name = "button" value = "Update">
			</form>
			<form action = "company.php" method = "POST">
			<input class="button" type = "submit" name = "button" value = "Cancel">
		</form>
			</div>
		</div>
	</div>
EOT;
?>
	</body>
</html>

