<?php session_start();?>
<html>            
<?php 
//session_start();

$cid = $_SESSION['cid'];
include ('conn.php');
echo "<table border=1 style=border-collapse:collapse>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Job ID</td><td></td><td></td>";
        echo "<td>Location</td><td></td><td></td>";
        echo "<td>Title</td><td></td><td></td>";
        echo "<td>Salary</td><td></td><td></td>";
        echo "<td>Academic requirement</td><td></td><td></td>";
        echo "<td>Major requirement</td><td></td><td></td>";
        echo "<td>Desciption</td><td></td><td></td>";
        echo "<td>Postdate</td><td></td><td></td>";
        echo "<td>"?>
  <form action = "pushto.php" method = "POST">
  <input class="button" type = "submit" name = "back" value = "Push to">
  <?php
      echo"</td><td></td><td></td>";
        echo "</tr>";

$getjob = mysqli_query($conn, "select * from JobAnncmnt where cid = '$cid' order by postdate desc;");
$cnt_job = mysqli_num_rows($getjob);
if($cnt_job==0){
      echo '<html><head><Script Language="JavaScript">alert("No job right now");</Script></head></html>'              . "<meta http-equiv=\"refresh\" content=\"0;url=company.php\">";
     }
else{
      while($result = mysqli_fetch_row($getjob)){
      echo "<tr>";
      echo "<td>$result[0]</td><td></td><td></td>";
      $jid = $result[0];
      echo "<td>$result[2]</td><td></td><td></td>";
      echo "<td>$result[3]</td><td></td><td></td>";
      echo "<td>$result[4]</td><td></td><td></td>";
      echo "<td>$result[5]</td><td></td><td></td>";
      echo "<td>$result[6]</td><td></td><td></td>";
      echo "<td>$result[7]</td><td></td><td></td>";
      echo "<td>$result[8]</td><td></td><td></td>";
      echo "<td>";
      print<<<EOT
      <input type="radio", name="jid", value="$jid">
EOT;
      echo"</td><td></td><td></td>";
      echo "</tr>";
       }
        echo "</table><br>";}
mysqli_close($conn);
?>
</form>
<?php
print <<<EOT
<form action = "company.php" method = "POST">
            <input class="button" type = "submit" name = "back" value = "Back">
            </form>

EOT;

?>