<?php

include ('conn.php');

//check username/password empty
if($username==null||$password==null){  
        echo '<html><head><Script Language="JavaScript">alert("Username/Password cannot be empty");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=signup.php\">";  
}  
//insert into database
else{
	$userExist = mysqli_query($conn, "select * from LoginCom where user = '$username';");
	$row_cnt = mysqli_num_rows($userExist);
	// check username existance
	if ($row_cnt == 0) {
		mysqli_query($conn, "INSERT INTO LoginCom (user,password) VALUES ('$username', '$password');");
		$getcid = mysqli_query($conn, "select cid from LoginCom where user = '$username';");
		$cid = mysqli_fetch_row($getcid)[0];
		mysqli_query($conn, "INSERT INTO Company (cid) VALUES('$cid');");
	} 
	else {
		echo '<html><head><Script Language="JavaScript">alert("Username is used. Please select another one");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=signup.php\">"; 
	}
}

mysqli_close($conn);
?>