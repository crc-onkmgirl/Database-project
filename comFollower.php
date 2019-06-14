<?php session_start();

$cid = $_SESSION['cid'];
include ('conn.php');
echo "<table border=1 style=border-collapse:collapse>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Student ID</td><td></td><td></td>";
    echo "<td>Name</td><td></td><td></td>";
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

$sql = mysqli_query($conn, "select sid, sname, university, major, gpa, interest, resume from FollowCompany natural join Student where cid = '$cid' ");
$cnt = mysqli_num_rows($sql);
if($cnt==0){
      echo '<html><head><Script Language="JavaScript">alert("No followers right now");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
     }
else{
      while($row = mysqli_fetch_row($sql)){
      echo "<tr>";
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
mysqli_close($conn);

print <<<EOT
<form action = "company.php" method = "POST">
            <input class="button" type = "submit" name = "back" value = "Back">
            </form>
EOT;
?>