<?php session_start();?>
<?php
$fromsid = $_SESSION['sid'];
$tosid = $_GET['tosid'];
$_SESSION['msgToSid'] = $tosid;

$conn = mysqli_connect('127.0.0.1','root','0224','project') or die('Could not connect: ' . mysql_error());

echo "Send Message to ";
$getToName = mysqli_query($conn,"select sname from Student where sid = $tosid");
$toName = mysqli_fetch_row($getToName)[0];
echo $toName;
echo "<br>Text: <br>";

echo "<form action = \"save-message.php\" method = \"POST\">";
echo "<input type = \"text\" name = \"msgText\"/><br>";
echo "<input type = \"submit\" name = \"sendmsg\" value = \"Send\"/></form>";

echo "<form action = \"student.php\" method = \"post\">";
echo "<input type =\"submit\" value = \"GoBack\"></form>";
?>