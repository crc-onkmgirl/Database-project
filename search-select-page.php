<?php session_start();?>
<?php
$_SESSION['searchText'] = $_POST['searchText'];
if ($_POST['searchType'] == company) {
	header("Location:search-company.php");
} else if ($_POST['searchType'] == student) {
	header("Location:search-student.php");
} else {
	header("Location:search-job.php");
}
?>