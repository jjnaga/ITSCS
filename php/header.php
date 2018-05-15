<?php

  $grres = mysql_query("SELECT * from user_groups where uid=" . $user_row["uid"], $db);
  $roles = mysql_fetch_assoc($grres);
  $helpdesk = FALSE;

  if ($roles['helpdesk'] == 'yes') {
    $helpdesk = TRUE;
  }

?>

<header class="cd-morph-dropdown">
  <a href="main.php">
    <img src="img/its.svg" id="logo">
  </a>

  <a href="#0" class="nav-trigger">Open Nav
    <span aria-hidden="true"></span>
  </a>

  <nav class="main-nav">
    <ul>
      <li class="has-dropdown" data-content="tools">
        <a href="#0">Tools</a>
      </li>

      <li class="has-dropdown" data-content="downloads">
        <a href="#0">Downloads</a>
      </li>

      <li class="has-dropdown" data-content="documentation">
        <a href="#0">Documentation</a>
      </li>

      <li class="has-dropdown" data-content="userdocs">
        <a href="#0">User Docs</a>
      </li>

      <li class="has-dropdown" data-content="administration">
        <a href="#0">Administration</a>
      </li>

      <li class="has-dropdown" data-content="none">
        <a href="logout.php" >Logout</a>
      </li>
    </ul>
  </nav>

  <div class="morph-dropdown-wrapper">
    <div class="dropdown-list">
      <ul>
        <li id="none" class="dropdown links">
          <a href="#0" class="label" id="logoutlabel">Logout</a>

          <div class="content">
            
          </div>
        </li>

        <li id="tools" class="dropdown links">
          <a href="#0" class="label">Tools</a>

          <div class="content">
            <div class="primarygrp" id="toollinks">

              <a href="https://csocits.slack.com/" target="_blank" class="linkcontainer">
                <h3 class="linktitle linkicon titlecolor">
                  <img src="img/Slack.svg"> Slack
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">Slide into those DMs.</span>
              </a>

              <a href="https://www.hawaii.edu/uhimc/" target="_blank" class="linkcontainer">
                <h3 class="linktitle linkicon titlecolor">
                  <img src="img/UHIMC.svg"> UHIMC
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">Lookup UH records (for official use only).</span>
              </a>

              <a href="https://www.hawaii.edu/simp/" target="_blank" class="linkcontainer">
                <h3 class="linktitle linkicon titlecolor">
                  <img src="img/simp.svg"> SIMP
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">Access our ticket system.</span>
              </a>

              <a href="https://gmail.hawaii.edu" target="_blank" class="linkcontainer">
                <h3 class="linktitle linkicon titlecolor">
                  <img src="img/Gmail.svg"> UH Gmail
                </h3>
                <span class="linksub">Google @ UH Email service.</span>
              </a>
            </div>

            <div class="secondarygrp" id="toolsecondary">
              <ul>
                <li>
                  <a href="https://www.hawaii.edu/help/hdsupport/email/index.php" class="linktitle linkicon">
                    <img src="img/Email.svg">
                    Email Generator
                  </a>
                </li>
                <li>
                  <a href="http://www.hawaii.edu/its/id/" target="_blank" class="linktitle linkicon">
                    <img src="img/Rio.svg">
                    Dept/RIO Management
                  </a>
                </li>
                <li>
                  <a href="http://net.its.hawaii.edu/" target="_blank" class="linktitle linkicon">
                    <img src="img/IP.svg">
                    IP/MAC Lookup
                  </a>
                </li>
                <li>
                  <a href="https://www.hawaii.edu/software" target="_blank" class="linktitle linkicon">
                    <img src="img/Software.svg">
                    Software Download Page
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>

        <li id="downloads" class="dropdown links">
          <a href="#0" class="label">Downloads</a>

          <div class="content">
            <div class="primarygrp">
              <div class="linkcontainer">
                <h3 class="linktitle linkicon">
                  <img src="img/Downloads.svg">
                  Waiver Downloads
                </h3>
                <span class="linksub">Choose the appropriate waiver type.</span>
              </div>
              <div id="waivers">
                <a href="https://www.hawaii.edu/help/hdsupport/get_file.php?fid=1155" target="_blank" >Waiver of Liability</a>
                <a href="https://www.hawaii.edu/help/hdsupport/get_file.php?fid=1156" target="_blank" >Waiver for Disk Recovery</a>
                <a href="https://www.hawaii.edu/help/hdsupport/get_file.php?fid=1157" target="_blank" >Waiver for Drop-Offs</a>
              </div>
            </div>
            <div class="secondarygrp">
              <ul>
                <li>
                  <a href="https://www.hawaii.edu/help/hdsupport/get_file.php?fid=1158" target="_blank" class="linktitle linkicon">
                    <img src="img/Contract.svg">
                    Contract for Phone Headsets
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>

        <li id="documentation" class="dropdown button">
          <a href="#0" class="label" style="color: #6772e5;">Documentation</a>

          <div class="content">
            <div class="primarygrp">
              <a href="https://www.hawaii.edu/bwiki/display/help/Home" target="_blank" class="linkcontainer" id="docgrp">
                <h3 class="linktitle linkicon">
                  <svg width="17" height="17" viewBox="0 0 17 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Canvas" fill="none">
                      <g id="documentation">
                        <g id="Vector">
                          <path id="vector1" d="M 0.945 2.57492e-08L 4.577 2.57492e-08C 6.744 2.57492e-08 8.5 1.007 8.5 2.832L 8.5 14.415C 7.988 14.415 7.485 14.078 7.17 13.825C 6.14 12.997 4.113 12.997 1.948 12.997L 0.945 12.997C 0.821032 12.9971 0.698252 12.9728 0.583671 12.9255C 0.469089 12.8782 0.36495 12.8088 0.277198 12.7212C 0.189447 12.6337 0.119802 12.5297 0.0722403 12.4152C 0.0246785 12.3007 0.000131252 12.178 0 12.054L 0 0.946C 0 0.424 0.423 0.002 0.945 0.002L 0.945 2.57492e-08Z"
                            fill="#87BBFD" />
                        </g>
                        <g id="Vector_2">
                          <path id="vector2" d="M 7.555 2.57492e-08L 3.923 2.57492e-08C 1.757 2.57492e-08 0 1.007 0 2.832L 0 14.415C 0.512 14.415 1.015 14.078 1.33 13.825C 2.36 12.997 4.387 12.997 6.552 12.997L 7.555 12.997C 7.67914 12.9971 7.80208 12.9728 7.91679 12.9253C 8.0315 12.8779 8.13573 12.8083 8.22351 12.7205C 8.31129 12.6327 8.38089 12.5285 8.42833 12.4138C 8.47578 12.2991 8.50013 12.1761 8.5 12.052L 8.5 0.947C 8.50013 0.822864 8.47578 0.699921 8.42833 0.585209C 8.38089 0.470496 8.31129 0.366268 8.22351 0.278491C 8.13573 0.190713 8.0315 0.12111 7.91679 0.0736658C 7.80208 0.0262217 7.67914 0.00186843 7.555 0.002L 7.555 2.57492e-08Z"
                            transform="translate(8.5 0)" fill="#6772E5" />
                        </g>
                      </g>
                    </g>
                  </svg>
                  <?php 
                    if ($helpdesk) {
                      echo "Help Desk Wiki";
                    }
                    else {
                      echo "Lab Wiki";
                    }
                  ?>
                </h3>
                <span class="linksub">Review any <?php if ($helpdesk) {echo "Help Desk";} else {echo "ITS Lab";} ?> procedure.</span>
              </a>
              <div class="docArticles">
                <ul>
                  <li><h4>Common Docs</h4></li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Phone+Procedures+and+FAQ' target='_blank'>Phones</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/General+Job+Information' target='_blank'>General Info</a>";
                    }
                    ?> 
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Schedule+and+Attendance+Policies' target='_blank'>Attendance</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Important+Info' target='_blank'>Important Info</a>";
                    }
                    ?> 
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Email+Procedures' target='_blank'>Email</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/pages/viewpage.action?pageId=554893403' target='_blank'>ITS Lab Policies</a>";
                    }
                    ?> 
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Help+Desk+Policies+and+Procedures' target='_blank'>General Policies</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Lab+Monitor+Policies' target='_blank'>Monitor Policies</a>";
                    }
                    ?>                   
                  </li>
                </ul>
                <ul>
                  <li><h4><?php if ($helpdesk) {echo "Popular Topics";} else {echo "Lab Procedures";} ?></h4></li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/ID+Management+Procedures' target='_blank'>ID Management</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Lab+Monitor+Policies' target='_blank'>General Procedures</a>";
                    }
                    ?>            
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/File+Drop+Procedures' target='_blank'>File Drop</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Lab+Monitor+Policies' target='_blank'>Compromised Users</a>";
                    }
                    ?>            
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Service+Window+Procedures' target='_blank'>Service Window</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Lab+Monitor+Policies' target='_blank'>SIMP</a>";
                    }
                    ?>                            
                  </li>
                  <li>
                    <?php 
                      if ($helpdesk) {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Data+Center+Access+Procedures' target='_blank'>Data Center Access</a>";
                    }
                    else {
                      echo "<a href='https://www.hawaii.edu/bwiki/display/help/Lab+Monitor+Policies' target='_blank'>Service Window</a>";
                    }
                    ?>                            
                  </li>
                </ul>
              </div>
            </div>

            <div class="secondarygrp">
              <ul>
                <li>
                  <?php 
                    if ($helpdesk) {
                      echo "<a href='https://drive.google.com/drive/folders/0B4v6QnBNmu9KMVdqYXFqeGVndEE' target='_blank' class='linktitle linkicon'>";
                    }
                    else {
                      echo "<a href='https://drive.google.com/drive/folders/0Byo69lUtfgcqQnVleWxTbG1IcVE' target='_blank' class='linktitle linkicon'>";
                    }
                  ?>     
                    <img src="img/Schedules.svg">
                    <?php if ($helpdesk) {echo "Help Desk Schedules";} else {echo "Lab Schedules";} ?>
                  </a>
                </li>
                <li>
                  <a href="https://www.hawaii.edu/help/hdsupport/get_file.php?fid=1309" target="_blank" class="linktitle linkicon">
                    <img src="img/BuildingIP.svg">
                    Building IP List
                  </a>
                </li>
                <li>
                  <a href="https://www.hawaii.edu/bwiki/display/help/Phone+Numbers+and+Useful+Info" target="_blank" class="linktitle linkicon">
                    <img src="img/Phone.svg">
                    Phone Numbers &amp; Useful Info
                  </a>
                </li>
                <li>
                  <a href="https://docs.google.com/spreadsheets/d/1EKtgS_CrdjCTtQGfuk461VzbjjBTYBkW0mOpt2ZjhcE/edit#gid=0" target="_blank" class="linktitle linkicon">
                    <img src="img/Checklist.svg"> 
                    Operations Checklist
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>

        <li id="userdocs" class="dropdown button">
          <a href="#0" class="label" style="color: #e39f48;">User Docs</a>
        
          <div class="content">
            <div class="primarygrp">
              <a href="http://hawaii.edu/askus/" target="_blank" class="linkcontainer" id="askus">
                <h3 class="linktitle linkicon">
                  <img src="img/AskUs.svg">
                  AskUs Articles
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">A collection of instructional articles.</span>
              </a>

              <a href="http://myuhinfo.hawaii.edu/page/campusreps.html" target="_blank" class="linkcontainer" id="reps">
                <h3 class="linktitle linkicon">
                  <img src="img/Reps.svg">
                  ITS Campus Reps
                </h3>
                <span class="linksub">Hours &amp; location of PW reset reps.</span>
              </a>
            </div>

            <div class="secondarygrp">
              <ul>
                <li>
                  <a href="https://www.hawaii.edu/askus/588" target="_blank" class="linktitle linkicon">
                    <img src="img/Policy.svg"> 
                    ITS Support Policy
                  </a>
                </li>
                <li>
                  <a href="https://www.hawaii.edu/itslab/" target="_blank" class="linktitle linkicon">
                    <img src="img/Labs.svg"> 
                    ITS Labs Homepage
                  </a>
                </li>
                <li>
                  <a href="http://myuhinfo.hawaii.edu/page/studentservices.html" target="_blank" class="linktitle linkicon">
                    <img src="img/AnR.svg"> 
                    A&amp;R Representatives
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>

        <li id="administration" class="dropdown button">
          <a href="#0" class="label" style="color: #b76ac4;">Administration</a>
          <div class="content">
            <div class="primarygrp">
              <a href="https://www.hawaii.edu/help/hdsupport/admin/schedmgmt/" class="linkcontainer">
                <h3 class="linktitle linkicon admincolor">
                  <img src="img/Schedule.svg"> Schedule Management
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">Edit &amp; view schedules/timesheets.</span>
              </a>
              <a href="https://www.hawaii.edu/help/hdsupport/admin/acctmgmt/" class="linkcontainer">
                <h3 class="linktitle linkicon admincolor">
                  <img src="img/Account.svg"> Account Management
                </h3>
                <span class="linksub" style="margin-bottom: 24px;">Add/Edit users to HDSupport.</span>
              </a>
              <a href="https://www.hawaii.edu/help/hdsupport/browser/index.php" class="linkcontainer">
                <h3 class="linktitle linkicon admincolor">
                  <img src="img/Matrix.svg"> Browser Recommendations
                </h3>
                <span class="linksub">Manage the browser matrix.</span>
              </a>
            </div>

            <div class="secondarygrp">
              <ul>
                <li>
                  <a href="https://www.hawaii.edu/help/hdsupport/waiver/" class="linktitle linkicon">
                    <img src="img/waiver.svg">
                    Waiver Management
                  </a>
                </li>
                <li>
                  <a href="https://depts.its.hawaii.edu/dwb/phpMyAdmin-41/" target="_blank" class="linktitle linkicon">
                    <img src="img/database.svg">
                    PHP MyAdmin 
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
      </ul>

      <div class="bg-layer" aria-hidden="true"></div>
    </div>
    <!-- dropdown-list -->
  </div>
  <!-- morph-dropdown-wrapper -->
</header>