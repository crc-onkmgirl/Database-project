<?php

session_start();
$pushtosid = $_SESSION['pushtosid'];
$cid = $_SESSION['cid'];
$jid = $_POST['jid'];
$date = date("Y-m-d h:i:s");

if(empty($pushtosid)){
	echo '<html><head><Script Language="JavaScript">alert("No student selected");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
}
elseif(empty($jid)){
	echo '<html><head><Script Language="JavaScript">alert("No job selected");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=pushjob.php\">";
}
else{
	include('conn.php');
	mysqli_query($conn, "INSERT INTO PushJob(jid, sid, pushdate, status) VALUES ('$jid','$pushtosid','$date','unchecked')");
	echo '<html><head><Script Language="JavaScript">alert("Job pushed successfully");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
}
mysqli_close($conn);
?>