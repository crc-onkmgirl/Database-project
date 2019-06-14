<?php

$sname = $_POST['sname'];
$su = $_POST['su'];
$smaj = $_POST['smaj'];
$sgpa = $_POST['sgpa'];
$sresume = $_POST['sresume'];
$keyother = $_POST['keyother'];

include('conn.php');
echo "<table border=1 style=border-collapse:collapse>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Student ID</td><td></td><td></td>";
    echo "<td>Student name</td><td></td><td></td>";
        echo "<td>University</td><td></td><td></td>";
        echo "<td>Major</td><td></td><td></td>";
        echo "<td>GPA</td><td></td><td></td>";
        echo "<td>Interest</td><td></td><td></td>";
        echo "<td>Resume</td><td></td><td></td>";
        echo "<td>"?>
  <form action = "pushjob.php" method = "POST">
  <input class="button" type = "submit" name = "back" value = "Push">
  <?php
  echo"</td><td></td><td></td>";
        echo "</tr>";
//check empty
if($sname==null&&$su==null&&$smaj==null&&$sgpa==null&&$sresume==null&&$keyother==null){  

	$getstu = mysqli_query($conn, "select sid, sname, university,major, gpa, interest, resume from Student ");
while($row = mysqli_fetch_row($getstu)){
        echo "<td>$row[0]</td><td></td><td></td>";
        $sid = $row[0];
        echo "<td>$row[1]</td><td></td><td></td>";
        echo "<td>$row[2]</td><td></td><td></td>";
        echo "<td>$row[3]</td><td></td><td></td>";
        echo "<td>$row[4]</td><td></td><td></td>";
        echo "<td>$row[5]</td><td></td><td></td>";
        echo "<td>$row[6]</td><td></td><td></td>";
        echo "<td>";
      print<<<EOT
      <input type="radio", name="pushtosid", value="$sid">
      </form>
EOT;
      echo"</td><td></td><td></td>";
      echo "</tr>";
       }
        echo "</table><br>";}

// do sql
else{
	 $wherelist = array();
  if(!empty($_POST['sname'])){
     $wherelist[] = "sname like '%{$_POST['sname']}%'";
  }
   if(!empty($_POST['su'])){
     $wherelist[] = "university like '%{$_POST['su']}%'";
  }
   if(!empty($_POST['smaj'])){
    $wherelist[] = "major like '%{$_POST['smaj']}%'";
  }
   if(!empty($_POST['sgpa'])){
    $wherelist[] = "gpa like '%{$_POST['sgpa']}%'";
  }
  if(!empty($_POST['sresume'])){
    $wherelist[] = "resume like '%{$_POST['sresume']}%'";
  }
  if(!empty($_POST['keyother'])){
    $wherelist[] = "interest like '%{$_POST['keyother']}%'";
  }
  //configure
 if(count($wherelist) > 0){
    $where = " where ".implode(' AND ' , $wherelist); 
 }

     $sql = mysqli_query($conn, "select sid, sname, university,major, gpa, interest, resume from Student $where ");
     $cnt = mysqli_num_rows($sql);
     if($cnt==0){
     	echo '<html><head><Script Language="JavaScript">alert("No results. Try some other keywords");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
     }
     else{
       while($row = mysqli_fetch_row($sql)){
        echo "<td>$row[0]</td><td></td><td></td>";
        $sid = $row[0];
        echo "<td>$row[1]</td><td></td><td></td>";
        echo "<td>$row[2]</td><td></td><td></td>";
        echo "<td>$row[3]</td><td></td><td></td>";
        echo "<td>$row[4]</td><td></td><td></td>";
        echo "<td>$row[5]</td><td></td><td></td>";
        echo "<td>$row[6]</td><td></td><td></td>";
        echo "<td>";
      print<<<EOT
      <input type="radio", name="pushtosid", value="$sid">
      </form>
EOT;
      echo"</td><td></td><td></td>";
      echo "</tr>";
       }
        echo "</table><br>";}
	
	
	}

mysqli_close($conn);
print <<<EOT
<form action = "company.php" method = "POST">
            <input class="button" type = "submit" name = "back" value = "Back">
            </form>
EOT;

?>
