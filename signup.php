<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		body{
			background-color: #f3f3f3;
		}
		.signupform {
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
	<div class = "signupform">
		<div class="form">
			<div>
				<form action = "select-page.php" method = "POST">
				<input class="textfiled" type = "text" placeholder="Username" name = "username">
				<input class="textfiled" type = "password" placeholder="Password" name = "password">
				<div>
				<input type="radio" name="user" value="student"><p>Student</p>
				<input type="radio" name="user" value="company"><p>Company</p>
				</div>
				<input class="button" type = "submit" name = "button" value = "Signup">	
				</form>
			</div>

			
		</div>
	</div>
	</body>


</html>