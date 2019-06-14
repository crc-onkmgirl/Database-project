<?php

include ('conn.php');

//check username/password empty
if($username==null||$password==null){  
    echo '<html><head><Script Language="JavaScript">alert("Username/Password cannot be empty");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";  
}
else{
    //check username
    $checkusr = mysqli_query($conn, "select * from LoginCom where user = '$username';");
    $usr_cnt = mysqli_num_rows($checkusr);
    if ($usr_cnt == 0) {
    	echo '<html><head><Script Language="JavaScript">alert("Username does not exist. Please sign up");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=signup.php\">";
    }
    else{
    	//check password
    	$checkpwd = mysqli_query($conn, "select password from LoginCom where user = '$username';");
    	$usrpwd = mysqli_fetch_row($checkpwd)[0];
    	if($password != $usrpwd){
    		echo '<html><head><Script Language="JavaScript">alert("Invalid username/password");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
    	}
    }
}

mysqli_close($conn);
?>  
		