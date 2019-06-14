<html><head>
<link href="company.css" rel="stylesheet" type="text/css">
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<?php
session_start();
$cid = $_SESSION['cid'];
$biu = $_POST['biu']; 


include('conn.php');
//display profile
if($biu=='Profile'){
	$sid = $_POST['sprofile'];
	if(!empty($sid)){
		$getprofile = mysqli_query($conn, "select sid, sname, university,major, gpa, qualification, interest, resume from Student where sid ='$sid'");
	$row = mysqli_fetch_row($getprofile);
	$row0 = $row[0];
	$row1 = $row[1];
	$row2 = $row[2];
	$row3 = $row[3];
	$row4 = $row[4];
	$row5 = $row[5];
	$row6 = $row[6];
	$row7 = $row[7];

print<<<EOT
<div id="home-left" class="col col-7 sm-col-3">
    <div class="row profile-card-action">
            <p></p><p></p><p>
            </p><p></p><table border="0">
            <tbody><tr><td><h3>Student Profile </h3></td></tr>
            <tr><td>Student ID: </td><td> $row0</td></tr>
            <tr><td>Student Name: </td><td> $row1</td></tr>
            <tr><td>University: </td><td> $row2</td></tr>
            <tr><td>Major: </td><td> $row3</td></tr>
            <tr><td>GPA: </td><td> $row4</td></tr>
            <tr><td>Qualification: </td><td> $row5</td></tr>
            <tr><td>Interest: </td><td> $row6</td></tr>
            <tr><td>Resume: </td><td> $row7</td></tr>
            
            </tbody></table>
            <form action="commessage.php" method="POST">
            <input class="button" type="submit" name="Update" value="Back">
            </form>
            </div>
           </div>
EOT;

	}
	else
		
	{
		echo '<html><head><Script Language="JavaScript">alert("No student selected");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=commessage.php\">"; 
	}
}
//update msn
else{
	$adate = $_POST['unmsn'];
	if(!empty($adate)){
		$update = "UPDATE Apply SET status='checked' where applydate='$adate'";
		mysqli_query($conn, $update);
		echo '<html><head><Script Language="JavaScript">alert("Application checked");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=commessage.php\">";
	}
	else
	{
		echo '<html><head><Script Language="JavaScript">alert("No application selected");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=commessage.php\">";
	}
}
mysqli_close($conn);
?>
</html>