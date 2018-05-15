<?php

 //BEGIN AUTHENTICATION

  session_start();
  include "./functions/do_auth.php";

//END AUTHENTICATION

  if (isset($_SESSION["host"])) {
	$host = $_SESSION["host"];
  } else {
	$host = "https://www.hawaii.edu/help/hdsupport/";
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITS Timesheet</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/link_timelayout.css">
    <link rel="stylesheet" href="css/dropdown.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>

<body>

  <div class="contain">
    <?php
        include 'header.php';

        if(!isset($_POST["results"])) {

        echo "No date information received.<br />";
        echo "Please go <a href=\"" . $host . "clock.php\">here</a> to request a timesheet.";

        } else {

        $username = $_POST["username"];

        $month = (int) $_POST["month"];
        $day   = (int) $_POST["day"];
        $year  = (int) $_POST["year"];

        if($_POST["ctype"] == "all")
            $result = mysql_query("Select * from log where username=\"" . $username . "\" and year >=\"" . $year . "\"", $db);
        else if($_POST["ctype"] == "logins")
            $result = mysql_query("Select * from log where action=\"in\" and username=\"" . $username . "\" and year >=\"" . $year . "\"", $db);
        else if($_POST["ctype"] == "logouts")
            $result = mysql_query("Select * from log where action=\"out\" and username=\"" . $username . "\" and year >=\"" . $year . "\"", $db);

    ?>
    <div class="listTimeFlex">
        <img src="img/listtimes.svg">
        <h1 class='section-title'>History for: <b><?php echo $username; ?></b></h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Time</th>
                    <?php
                    if (isset($_POST["showip"]))
                        echo "<th>From</th>";
                    ?>
                    <?php
                    if (isset($_POST["showcomments"]))
                        echo "<th>Comments</th>";
                    ?>
            </tr>
        </thead>
        <?php

            while($row = mysql_fetch_assoc($result)) {

            if(($row["year"] > $year) || ($row["year"] == $year && $row["month"] > $month)
                || ($row["year"] == $year && $row["month"] == $month && $row["day"] >= $day)) {

                echo "<tr>";
                echo "<td>" . $row["month"] . "/" . $row["day"] . "/" . $row["year"] . "</td>";
                echo "<td>" . $row["action"] . "</td>";
                echo "<td>" . $row["hour"] . ":" . $row["min"] . " " . $row["ampm"] . "</td>";
                if(isset($_POST["showip"]))
                echo "<td>" . $row["hostname"] . " (" . $row["ip"] . ")" . "</td>";
                if(isset($_POST["showcomments"]))
                echo "<td>" . $row["comments"] . "</td>";
                echo "</tr>";
                }
            }
        ?>
        </table>
        <?php
        }
        ?>
        </div> 
  </div>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript" src="js/misc.js"></script>

</body>
