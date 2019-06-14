<?php session_start();?>
<?php
	if (isset($_POST['user'])) {
		$_SESSION['usr'] = $_POST['username'];
		$_SESSION['pwd'] = $_POST['password'];
		$_SESSION['button'] = $_POST['button'];
		if ($_POST['user'] == 'student') {
			header("Location:student.php");
		}else {
			header("Location:company.php");
		}
	}
	else{
		echo
	'<html><head><Script Language="JavaScript">alert("Please select a user type");</Script></head></html>' .                   "<meta http-equiv=\"refresh\" content=\"0;url=signup.php\">";
	}
?>
