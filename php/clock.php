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

//get username of the user logged into this session.
$userResult = mysql_query("Select * FROM users where expired = 0 and uuid = " .$uuid, $db);
$userinfo = mysql_fetch_assoc($userResult);
$username = $userinfo["username"];

//select all entries for the logged in user.
$actionresult = mysql_query("SELECT * FROM log where username = '".$username . "' ORDER BY logid ASC", $db) or die(mysql_error());
$lastaction = "out";
$lastip;
$lasthostname;
$lasthour;
$lastmin;
$lastday;
$lastmonth;
$lastyear;
$lastampm;
$lastdow;
$lastcomments;

//find the latest entry information
//*** MAKE THIS MORE EFFICIENT LATER ***
while($row = mysql_fetch_assoc($actionresult)) {

  $lastaction = $row["action"];
  $lastip = $row["ip"];
  $lasthostname = $row["hostname"];
  $lasthour = $row["hour"];
  $lastmin = $row["min"];
  $lastday = $row["day"];
  $lastmonth = $row["month"];
  $lastyear = $row["year"];
  $lastdow = $row["dow"];
  $lastampm = $row["ampm"];
  $lastcomments = $row["comments"];

}

//check whether the user has hit the Clock In/Out button.
//If so, take appropriate action depending on what the last action in table was.
if(isset($_POST["action"])) {

  $username = $userinfo["username"];
  $ip = $_SERVER["REMOTE_ADDR"];

  $hostname = gethostbyaddr($ip);
  $month = date("n");
  $day = date("j");
  $dow = date("l");
  $year = date("Y");
  $hour = date("g");
  $min = date("i");
  $ampm = date("A");
  $comments = addslashes($_POST["comments"]);
  $action;

  if($lastaction == "out")
    $action = "in";
  else if($lastaction == "in")
    $action = "out";

//  $logstr = "INSERT into log (username, ip, hostname, month, day, dow, year, hour, min, ampm, action, comments) ";
//  $logstr .= "VALUES ('" . $username . "', '" . $ip . "', '" . $hostname . "', '" . $month . "', '" . $day . "', '" . $dow . "', '" . $year . "', '" . $hour . "', '" . $min . "', '" . $ampm . "', '". $action . "', '" . $comments ."')";
//  $logres = mysql_query($logstr) or die(mysql_error());

  $getuid = mysql_query("SELECT uid FROM users WHERE username='" . $_SESSION["username"] . "'");

  //populating v1 clock table
  if ($action == "out" && $day != $lastday) { // checking out on a different day
     $inday = strtotime("$lastmonth/$lastday/$lastyear");
     $outday = strtotime("$month/$day/$year");
     while ($inday < $outday) {
        $clockstr = "INSERT into clock (uid, tstamp, action, ip, hostname, comments)
                          values (" . mysql_result($getuid, 0) . ",
			          " . ($inday+86399) . ",
				  'out',
				  '" . $ip . "',
				  '" . $hostname . "',
				  '" . $comments . "')";
        $clres = mysql_query($clockstr) or die(mysql_error());

        $logstr = "INSERT into log (username, ip, hostname, month, day, dow, year, hour, min, ampm, action, comments) ";
        $logstr .= "VALUES ('" . $username . "', '" . $ip . "', '" . $hostname . "', '" . date('n', $inday) . "', '" . date('j', $inday) . "', '" . date('l', $inday) . "', '" . date('Y', $inday) . "', '11', '59', 'PM', 'out', '" . $comments ."')";

        $logres = mysql_query($logstr) or die(mysql_error());

        $inday += 86400;
        $clockstr = "INSERT into clock (uid, tstamp, action, ip, hostname, comments)
                          values (" . mysql_result($getuid, 0) . ",
			          " . $inday . ",
				  'in',
				  '" . $ip . "',
				  '" . $hostname . "',
				  '" . $comments . "')";
        $clres = mysql_query($clockstr) or die(mysql_error());

        $logstr = "INSERT into log (username, ip, hostname, month, day, dow, year, hour, min, ampm, action, comments) ";
        $logstr .= "VALUES ('" . $username . "', '" . $ip . "', '" . $hostname . "', '" . date('n', $inday) . "', '" . date('j', $inday) . "', '" . date('l', $inday) . "', '" . date('Y', $inday) . "', '12', '00', 'AM', 'in', '" . $comments ."')";

        $logres = mysql_query($logstr) or die(mysql_error());
     }
  }

  $logstr = "INSERT into log (username, ip, hostname, month, day, dow, year, hour, min, ampm, action, comments) ";
  $logstr .= "VALUES ('" . $username . "', '" . $ip . "', '" . $hostname . "', '" . $month . "', '" . $day . "', '" . $dow . "', '" . $year . "', '" . $hour . "', '" . $min . "', '" . $ampm . "', '". $action . "', '" . $comments ."')";

  $logres = mysql_query($logstr) or die(mysql_error());

  $clockstr = "INSERT into clock (uid, tstamp, action, ip, hostname, comments)
                          values (" . mysql_result($getuid, 0) . ",
						          " . time() . ",
								  '" . $action . "',
								  '" . $ip . "',
								  '" . $hostname . "',
								  '" . $comments . "')";

  $clres = mysql_query($clockstr) or die(mysql_error());

  //after new entry has been successfully written to table, refresh this page to
  //update status and last action information for user.
  header("Location: ./clock.php");

}

?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Clock In/Out</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/dropdown.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

        <!-- real time ticker -->
        <script type="text/javascript">
            function updateClock() {
              var currentTime = new Date();
              var currentHours = currentTime.getHours();
              var currentMinutes = currentTime.getMinutes();
              var currentSeconds = currentTime.getSeconds();

              // Pad the minutes and seconds with leading zeros, if required
              currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
              currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;

              // Choose either "AM" or "PM" as appropriate
              var timeOfDay = (currentHours < 12) ? "AM" : "PM";

              // Convert the hours component to 12-hour format if needed
              currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

              // Convert an hours component of "0" to "12"
              currentHours = (currentHours == 0) ? 12 : currentHours;

              // Compose the string for display
              var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;

              // Update the time display
              document.getElementById("timestamp").firstChild.nodeValue = currentTimeString;
            }
        </script>
        <!-- /real time ticker -->

        <script type="text/javascript">
            setTimeout(function () { 
                location.reload();
            }, 60 * 4000);
        </script>
  </head>

  <body onload="updateClock(); setInterval('updateClock()', 1000 )">

    <div class="contain">

      <?php
        include 'header.php';
      ?>

      <section id='clockcard'>
        <form name="log" method ="post" action="clock.php">
        <div class="card" id="mainclock">
          <div id='mainclocktext'>
            <div>
              <div class="muted-text" id="nametext">
                <?php
                    echo "You <b>($username)</b> are:";
                ?>
                </div>
              <h2 class="title-text" id="<?php  if($lastaction == "in") echo "clockedin"; else if($lastaction == "out") echo "clockedout"; ?>" >
                <?php  
                if($lastaction == "in") 
                  echo "<img src='img/checkmark-outline.svg' class='clockicon'></img>";
                else if($lastaction == "out") 
                  echo "<img src='img/close-outline.svg' class='clockicon'></img>";
                ?>
                <?php
                    echo "Clocked $lastaction";
                ?>
              </h2>
            </div>
            <div>
                <div class="muted-text" id="timestamptext">The current time:</div>
                <div class="title-text numbers" id="timestamp">&nbsp;</div>
            </div>
            <div>
                <div class="body-text" id="comment">Have a weird clock-in/out?
                  <span id="commentbold">Write a comment!</span>
                </div>
                <textarea name="comments" type="text" class="clockcomments" id="clockcomment" placeholder="Write your comment here!"></textarea>
            </div>
          </div>
          <div>
            <?php  
                if($lastaction == "in") 
                  echo "<img src='img/coworkers.svg' class='clockimg' id='coworkers'></img>";
                else if($lastaction == "out") 
                  echo "<img src='img/chilling.svg' class='clockimg' id='coworkers'></img>";
              ?>
            <div id="clockButton">
              <div class="muted-text" style="margin-bottom: 6px; text-align: center;">
                <?php
                  if($lastaction == "in")
                    echo "Done with your shift?";
                  else if($lastaction == "out")
                    echo "Starting your shift?";
                ?>
              </div>
              <input href="#" type="submit" name="action" class="commonButton" id="<?php  if($lastaction == "in") echo "clockinButton"; else if($lastaction == "out") echo "clockoutButton"; ?>" 
               value=
              <?php
                    if($lastaction == "in")
                        echo "\"Clock Out\">";
                    else if($lastaction == "out")
                        echo "\"Clock In\">";
                ?>
                </input>
            </div>
          </div>
        </div>
        </form>

        <div class="card" id="sideclock">
          <div class="sideheading white-text">
              <?php  
                echo "Last Clock-$lastaction";
              ?>
          </div>
          <div class="sidestamp">
            <div class="white-text sideEmphasis">Your Timestamp:</div>
            <div class="white-text"><?php echo $lastdow; ?></div>
            <div class="white-text numbers"><?php echo "$lasthour:$lastmin $lastampm"; ?></div>
            <div class="white-text numbers"><?php echo "$lastmonth-$lastday-$lastyear"; ?></div>
          </div>
          <div id="sidecomments">
            <div class="white-text sideEmphasis">Your Comments:</div>
            <div class="white-text commenttext"><?php echo $lastcomments; ?></div>
          </div>
        </div>

        <div id="sidelaptop">
          <div id="laptop"></div>
        </div>

        <span id="whitebackground"></span>

        <div id="belowcomments" class="body-text">
          <img src="img/comments.svg"></img>
          <div>
            <div class="bottomemphasis">Use comments when clocking in/out outside of your scheduled shift.</div>
            <div class="bottomsubheading">Comments should include:</div>
            <ul style="padding-left: 24px;">
              <li class="listicon">A brief description of your reason.</li>
              <li class="listicon">Your normal working hours.</li>
              <li class="listicon">Which approving staff member, if any.</li>
            </ul>
            <div class="bottommuted" id="reprimand">
              You may be subject to reprimand if clocking in/out outside of your shift unless valid comments are made. 
            </div>
            <div class="bottommuted" id="falsify">
               Clocking in/out from an unauthorized device without checking with staff will be viewed as an attempt to falsify work hours.
            </div>
          </div>
        </div>

        <div id="commentexamples" class="body-text">
          <div>
            <div class="bottomemphasis">Need some comment examples?</div>

            <div class="commentsubheading">Shift from <b>8:00a-2:30p</b>, clocked out at <b>2:45p</b>:</div>
            <div class="bottomexample">"I was stuck on a call for 15 minutes, my shift ended at 2:30pm"</div>
                
            <div class="commentsubheading">Shift from <b>9:00a-3:00p</b>, clocked out at <b>2:30p</b>:</div>
            <div class="bottomexample">"I'm leaving 30 minutes early today, approved by Mike. My shift normally ends at 3:00pm"</div>
              
            <div class="commentsubheading">Shift from <b>8:00a-2:30p</b>, clocked in at <b>8:15a</b>:</div>
            <div class="bottomexample">"I was stuck in traffic and late this morning, my shift started at 8:00am"</div>                   
          </div>
        
          <img src="img/commentexample.svg"></img>
        </div>
        <span id="commentyborder"></span>
        <span id="coolgraybg"></span>

        <div id="timesheets">
          <img src="img/timesheet.svg"></img>
          <h1 class='section-title' style="align-self: center; text-align: center;">View your Timesheets</h1>

          <div id="timesheetcards">
            <form name="tsheet" method="post" autocomplete="off" action="list_times.php">
            <div class="footercard" id="historycard">
              <img src="img/show-timesheet.svg" class="sidecardimg"></img>
              <div class="bottomemphasis" id="timesheetheading">Clock-In/Out History</div>
              <div id="showTInputs">
                <input type="text" name="date" placeholder="mm/dd/yyyy">
                <select name="ctype">
                  <option value="all">All Actions</option>
                  <option value="logins">Clock-Ins</option>
                  <option value="logouts">Clock-Outs</option>
                </select>
              </div>
              
              <div style="margin-bottom: 12px;">
                <input name="showip" type="checkbox" id="displayIP">
                <label for="displayIP">Display IP</label>
                <input name="showcomments" type="checkbox" id="displayComments">
                <label for="displayComments">Display Comments</label>
              </div>
              <input type="submit" name="results" class="commonButton" id="showbutton" value="Get History"></input>
            </div>

            <input type="hidden" name="username" value="<?php echo $username; ?>" />
            </form>

            <form action="timesheet.php" method="post">
            <div class="footercard" id="tcard">
              <img src="img/printable-timesheet.svg" class="sidecardimg"></img>
              <div class="bottomemphasis" id="printableheading">Printable Timesheet</div>
              <p class="body-text">Generate a timesheet including the below date:</p>
              <input id="printinput" name="date" type="text" placeholder="mm/dd/yyyy">
              <input type="submit" name="submit" class="commonButton" id="printbutton" value="Get Timesheet"></input>
            </div>
            <input type="hidden" name="username" value="<?php echo $_SESSION["username"]; ?>" />
            </form>
          </div>
        </div>

        <div id="tooltip" style="display: none;">
          <img src="img/validation-error.svg" id="warningicon">
          <div>Don't forget to include your scheduled work hours in your comment.<br><br><span class="muted-text">Need help? See the examples below.</span></div>
        </div>

      </section>
    </div>

    <script src="https://unpkg.com/tippy.js@2.5.2/dist/tippy.all.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/dropdown.js"></script>
    <script type="text/javascript" src="js/misc.js"></script>

    <script>
      tippy('.clockcomments', {
        trigger: 'click',
        animation: 'perspective',
        placement: 'right',
        maxWidth: '220px',
        delay: 100,
        duration: 600,
        html: '#tooltip',
        theme: 'warning'
      })
    </script>

  </body>
</html>