<?php

session_start();

$cid = $_SESSION['cid'];
$title = $_POST['title'];
$location = $_POST['location'];
$salary = $_POST['salary'];
$jdgree = $_POST['jdgree'];
$jmajor = $_POST['jmajor'];
$description = $_POST['description'];

$pu1 = $_POST['pu1'];
$pu2 = $_POST['pu2'];;
$pgpa = $_POST['pgpa'];
$pmajor = $_POST['pmajor'];
$pdgree = $_POST['pdgree'];
$date = date("Y-m-d h:i:s");

include('conn.php');
//check empty job information
if($title==null||$location==null||$salary==null||$jdgree==null||$jmajor==null||$description==null){
	echo '<html><head><Script Language="JavaScript">alert("Information imcomplete. Please check again");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=postjob.php\">"; 
}
//insert into JobAnncmnt
else
{
	mysqli_query($conn, " INSERT INTO JobAnncmnt(cid, location, title, salary, jdgree, jmajor, description, postdate)VALUES ('$cid','$location','$title','$salary','$jdgree','$jmajor','$description','$date')");

	//check push state
    if($pu1==null&&$pu2==null&&$pgpa==null&&$pdgree==null&&$pmajor==null){
    	echo '<html><head><Script Language="JavaScript">alert("Job posted ");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">"; 

    }
    // push to
    else
{
    	// search qualified students
    	$wherelist = array();
    	if(!empty($pu1)){
    		$wherelist[] = "university='$pu1'";
    	}
        if(!empty($pu2)){
        	$wherelist[] = "university='$pu2'";
        }
        $where = " where ".implode(' OR ' , $wherelist);
        if(!empty($pgpa)){
        	$wherelist[] = "gpa>='$pgpa'";
        }
        if(!empty($pmajor)){
        	$wherelist[] = "major='$pmajor'";
        }
        if(!empty($pdgree)){
        	$wherelist[] = "qualification='$pdgree'";
        }
        $where = " where ".implode(' AND ' , $wherelist);
        $pushto = mysqli_query($conn, "select sid from Student $where ");
        $cnt_push = mysqli_num_rows($pushto);

        // update Pushjob
        if($cnt_push!=0){
        	$getjid = mysqli_query($conn, "select jid from JobAnncmnt where title='$title'");
        	$newjid = mysqli_fetch_row($getjid)[0];

        	while($qualifiedsid = mysqli_fetch_row($pushto)){
        		$pushsid = $qualifiedsid[0];
        		mysqli_query($conn, "INSERT INTO PushJob(jid, sid, pushdate, status) VALUES ('$newjid','$pushsid','$date','unchecked')");
        	}
        	echo '<html><head><Script Language="JavaScript">alert("Job posted and pushed");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
        }
    }
}
mysqli_close($conn);
?>