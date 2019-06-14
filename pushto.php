<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
        body{
            background-color: #f3f3f3;
        }
        .pushform {
            width: 360px;
            padding: 5% 0 0;
            margin: auto;
            
        }
        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0;
            padding: 36px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
        .form input.textfiled {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .form input.button {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            cursor:pointer;
        }
        p {
            font-size: 14px;
            margin: 0 0 10px;
        }
        </style>
    </head>

    <body>
    <div class = "pushjobform">
        <div class="form">
            <div>
            <table border = 0>
                <?php
                session_start();
                $jid = $_POST['jid'];
                $_SESSION['pushjid'] = $jid;
            echo"<p><tr><td><h3>Push job (jid: $jid) </h3></td></tr></p><p>";
            ?>
             <form action = "pushtocheck.php" method = "POST">
                <tr><td>Student ID:</td>
            <td><input class="textfiled" type = "text" name = "sid"></td></tr>
            <tr><td>Student name:</td>
            <td><input class="textfiled" type = "text" name = "sname"></td></tr>
            <tr><td>Preferred university1:</td>
            <td><input class="textfiled" type = "text" name = "pu1"></td></tr>
            <tr><td>Preferred university2:</td>
            <td><input class="textfiled" type = "text" name = "pu2"></td></tr>
            <tr><td>Minimum GPA: </td>
            <td><input class="textfiled" type = "text" name = "pgpa"></td></tr>
            <tr><td>Major: </td>
            <td><input class="textfiled" type = "text" name = "pmajor"></td></tr>
            <tr><td>Acadamic degree: </td>
            <td><input class="textfiled" type = "text" name = "pdgree"></td></tr></tr>
            </table>
            <input class="button" type = "submit" name = "button" value = "Push">
        </form>
        <form action = "alljobs.php" method = "POST">
            <input class="button" type = "submit" name = "button" value = "Cancel">
        </form>
            </div>
        </div>
    </div>
    </body>


</html>