<?php
session_start();
include('conn.php');

$cname = $_POST['cname'];
$headquarter = $_POST['headquarter'];
$industry = $_POST['industry'];
$cid = $_SESSION['cid'];


// check company name
$cnameExist = mysqli_query($conn, "select * from Company where cname = '$cname' and cid !='$cid'");
$row_cnt = mysqli_num_rows($cnameExist);
	if ($row_cnt == 0) {
		$update = "UPDATE Company SET cname='$cname', headquarter='$headquarter',industry='$industry' where cid='$cid'"; 
	mysqli_query($conn, $update);
	echo '<html><head><Script Language="JavaScript">alert("Update successful");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
    }
	else {
		echo '<html><head><Script Language="JavaScript">alert("Company name is used. Please select another one");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=comUpdate.php\">"; 
	}
mysqli_close($conn);
?>
	