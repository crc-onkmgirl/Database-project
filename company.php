<?php session_start();?>
<html><head>
<link href="company.css" rel="stylesheet" type="text/css">
<link href="css.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    
$mode =  $_SESSION['button'];
$username = $_SESSION['usr'];
$password = $_SESSION['pwd'];

if($mode=='Signup'){
    include('register_verify.php');
}
if($mode=='Login'){
    include('login_verify.php');
}

include('conn.php');
//information
$stmt = $conn->prepare("SELECT cid from LoginCom where user = ?");
$stmt->bind_param('s',$username);
$stmt->execute();
$getcid = $stmt->get_result();
$cid = mysqli_fetch_row($getcid)[0];
$_SESSION['cid']=$cid;
$getcname = mysqli_query($conn, "select cname from Company where cid = '$cid';");
$gethead = mysqli_query($conn, "select headquarter from Company where cid = '$cid'");
$getind = mysqli_query($conn, "select industry from Company where cid = '$cid'");
$cname = mysqli_fetch_row($getcname)[0];
$headquarter = mysqli_fetch_row($gethead)[0];
$industry = mysqli_fetch_row($getind)[0];


//follow
$sql = mysqli_query($conn, "select sid from FollowCompany where cid = '$cid';");
$cnt_fo = mysqli_num_rows($sql);
$sid_f = mysqli_fetch_row($sql)[0];
$getsmaj = mysqli_query($conn, "select major from Student where sid = '$sid_f'");
$getsname = mysqli_query($conn, "select sname from Student where sid = '$sid_f'");
$getsu = mysqli_query($conn, "select university from Student where sid = '$sid_f'");
$smaj_f = mysqli_fetch_row($getsmaj)[0];
$sname_f = mysqli_fetch_row($getsname)[0];
$su_f = mysqli_fetch_row($getsu)[0];


//unread message
$getunread = mysqli_query($conn, "select cid, jid, applydate from Apply natural join Company where cid = '$cid' and status='unchecked' order by applydate desc; ");
$cnt_msn = mysqli_num_rows($getunread);
if($cnt_msn==0){
	$MSN='Unchecked applications: 0';}
else{
    $MSN="<a href=/commessage.php>Unchecked applications: $cnt_msn</button></a>";
}
    

//jobs
$getjob = mysqli_query($conn, "select * from JobAnncmnt where cid = '$cid' order by postdate desc;");
$cjob = mysqli_fetch_row($getjob);
$cjid = $cjob[0];
$clocation = $cjob[2];
$cnt_job = mysqli_num_rows($getjob);
$cpostdate = $cjob[8];
$ctitle = $cjob[3];
$cdescription = $cjob[7];

print<<<EOT
		<header class="page-top">
	<div class="container">
    <h1>Jobster</h1>
		</div>	
	</header>
  
		<div id="home-left" class="col col-7 sm-col-3">
    <div class="card profile-card">
        <div class="content profile-body">
            <div class="profile-wrapper">
	            <div class="profile-info">
	                <h1 class="student-name">$username</h1>
	            </div>
            </div>


            <div class="row profile-card-action">
            <p></p><p></p><p>
            </p><p></p><table border="0">
            <tbody><tr><td><h3>Profile </h3></td></tr><tr><td>Company Name: </td><td> $cname</td></tr>
            <tr><td>Headquarter: </td><td> $headquarter</td></tr>
            <tr><td>Industry: </td><td> $industry</td></tr>
            
            </tbody></table>
            <form action="comUpdate.php" method="POST">
            <input class="button" type="submit" name="Update" value="Update">
            </form>
            </div>


            <div class="row profile-card-action">
            <p></p><p></p><p>
            </p><p></p><table border="0">
            <tbody><tr><td><h3>Followers: $cnt_fo</h3></td></tr><tr><td>$sname_f </td></tr>
            <tr><td>($su_f,$smaj_f)</td></tr>
            
            </tbody></table>
            <form action="comFollower.php" method="POST">
            <input class="button" type="submit" name="seeall" value="See All">
            </form>
            </div>


            <div class="row profile-card-action">      
            <p></p><h3>$MSN</h3><p></p><p>
            </p><form action="commessage.php" method="POST">
            <input class="button" type="submit" name="seeall" value="See All">
            </form>
            </div>


            <div class="row profile-card-action">
            <form action="index.php" method="POST">
            <input class="button" type="submit" name="Update" value="Logout">
            </form>
            </div>

        </div>
    </div>
</div>
	
<div id="home-right" class="col col-7 sm-col-7">
    <div class="card profile-card">
    </div>
    <p></p>
    <h2>Newest Job</h2>
    <p></p>
            <p></p><p></p><p>
            </p><p></p><table border="0">
            <tr><td>Job ID: </td><td> $cjid</td></tr>
            <tr><td>Title: </td><td> $ctitle</td></tr>
            <tr><td>Description: </td><td> $cdescription</td></tr>
            <tr><td>Postdate: </td><td> $cpostdate</td></tr>
            
            </tbody></table>
            <p></p>
    <form action="alljobs.php" method="POST">
    <p><input class="button" type="submit" name="seeall" value="See All Jobs"></p>
    </form>
    <form action="postjob.php" method="POST">
    <input class="button" type="submit" name="seeall" value="Post a new job">
    </form>
    <p></p>
            <div class="card profile-card">
    </div>


<div class="card profile-card">
</div>
<h2 class="student-name">Search students by:</h2>
<form action="comsearch.php" method="POST">
<p><tr><td><input class="textfiled" type = "text" placeholder="Student name" name = "sname"></td>
<td><input class="textfiled" type = "text" placeholder="University" name = "su"></td>
<td><input class="textfiled" type = "text" placeholder="Major" name = "smaj"></td></tr></p>
<input class="textfiled" type = "text" placeholder="GPA" name = "sgpa">
<input class="textfiled" type = "text" placeholder="Resume" name = "sresume">
<input class="textfiled" type = "text" placeholder="Others" name = "keyother">
<p></p>
<p><input class="button" type="submit" name="seeall" value="Search"></p>
    </form>
<div class="card profile-card">
</div>




<h2 class="student-name">Students for you</h2>
<h0 class="student-name">Not sure whom you are looking for? Try these recommended students.</h0>
EOT;
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

$follower = mysqli_query($conn, "select sid, sname, university, major, gpa, interest, resume from FollowCompany natural join Student where cid = '$cid';");
while($row = mysqli_fetch_row($follower)){
	echo "<td>$row[0]</td><td></td><td></td>";
        echo "<td>$row[1]</td><td></td><td></td>";
        $sid = $row[0];
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

$relevant = mysqli_query($conn, "select sid, sname, university, major, gpa, interest, resume from Student where major like '%$industry%' or resume like '%$industry%' or interest like '%$industry%' ");
while($relevantstd = mysqli_fetch_row($relevant)){
	echo "<td>$relevantstd[0]</td><td></td><td></td>";
	 $sid = $relevantstd[0];
        echo "<td>$relevantstd[1]</td><td></td><td></td>";
        echo "<td>$relevantstd[2]</td><td></td><td></td>";
        echo "<td>$relevantstd[3]</td><td></td><td></td>";
        echo "<td>$relevantstd[4]</td><td></td><td></td>";
        echo "<td>$relevantstd[5]</td><td></td><td></td>";
        echo "<td>$relevantstd[6]</td><td></td><td></td>";
echo "<td>";
      print<<<EOT
      <input type="radio", name="pushtosid", value="$sid">
      </form>
EOT;
      echo"</td><td></td><td></td>";
      echo "</tr>";
       }
       echo "</table><br>";
?>
</div>
</body>
</html>