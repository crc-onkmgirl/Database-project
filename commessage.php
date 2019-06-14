<?php
session_start();
$cid = $_SESSION['cid'];
include('conn.php');

$getun = mysqli_query($conn, "select sid, sname, jid, applydate, status from Apply natural join Student natural join JobAnncmnt where cid = '$cid' and status='unchecked' ");
$getmsn = mysqli_query($conn, "select sid, sname, jid, applydate, status from Apply natural join Student natural join JobAnncmnt where cid = '$cid' order by status desc");


//unchecked msn
echo"<h2>Unchecked Applications</h2>";
echo "<table border=1 style=border-collapse:collapse>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
  print<<<EOT
  <form action = "msncheck.php" method = "POST">
EOT;
        echo "<td></td><td>Student ID</td><td></td><td></td>";
        echo "<td>Student name</td><td></td><td></td>";
        echo "<td>";
        print<<<EOT
        <input class="button" type = "submit" name = "biu" value = "Profile">
EOT;
        echo"</td><td></td><td></td>";
        echo "<td>Job ID</td><td></td><td></td>";
        echo "<td>Applydate</td><td></td><td></td>";
        echo "<td>";
        print<<<EOT
        <input class="button" type = "submit" name = "biu" value = "Mark as checked">
EOT;
        echo"</td><td></td><td></td>";
        echo "</tr>";

     
  while($row = mysqli_fetch_row($getun)){
        echo "<tr>";
        echo "<td></td><td>$row[0]</td><td></td><td></td>";
        $sid = $row[0];
        echo "<td>$row[1]</td><td></td><td></td>";
        echo "<td>";
      print<<<EOT
      <input type="radio", name="sprofile", value="$sid">
      
EOT;
      echo"</td><td></td><td></td>";
        echo "<td>$row[2]</td><td></td><td></td>";
        echo "<td>$row[3]</td><td></td><td></td>";
                $adate = $row[3];
        echo "<td>";
      print<<<EOT

      <input type="radio", name="unmsn", value="$adate">
</form>
EOT;
      echo"</td><td></td><td></td>";
      echo "</tr>";
       }
      echo "</table><br>";

//all msn
echo"<h2>Unchecked Applications</h2>";  
echo "<table border=1 style=border-collapse:collapse>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
  print<<<EOT
  <form action = "msncheck.php" method = "POST">
EOT;
        echo "<td></td><td>Student ID</td><td></td><td></td>";
        echo "<td>Student name</td><td></td><td></td>";
        echo "<td>";
        print<<<EOT
        <input <input class="button" type = "submit" name = "biu" value = "Profile">
EOT;
        echo"</td><td></td><td></td>";
        echo "<td>Job ID</td><td></td><td></td>";
        echo "<td>Applydate</td><td></td><td></td>";
        echo "<td>Status</td><td></td><td></td>";
  while($ro = mysqli_fetch_row($getmsn)){
        echo "<tr>";
        echo "<td></td><td>$ro[0]</td><td></td><td></td>";
        $sid = $ro[0];
        echo "<td>$ro[1]</td><td></td><td></td>";
        echo "<td>";
      print<<<EOT
      <input type="radio", name="sprofile", value="$sid">
      </form>
EOT;
      echo"</td><td></td><td></td>";
        echo "<td>$ro[2]</td><td></td><td></td>";
        echo "<td>$ro[3]</td><td></td><td></td>";
        echo "<td>$ro[4]</td><td></td><td></td>";
      echo "</tr>";
       }

        echo "</table><br>";

  mysqli_close($conn);
?>

<form action = "company.php" method = "POST">
  <input class="button" type = "submit" name = "back" value = "Back">
</form>
