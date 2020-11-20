<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : footer.php
    *? DESCRIPTION : Display buttons / links to other web pages.
    *?               Same functionality as header.php , keep the
    *?               web application well structured.
    *? CREATED ON  : 01-09-2020
    *? EDITED ON   : 09-09-2020
    *********************************************/

    include("settings/functions.php");
    include("settings/config.php");
    if (isset($_GET['submit'])) {
        $jobTitle = sanitisedInput($_GET['findJob']);
        $searchJobLocation = $_GET['searchJobLocation'];
        $errMsg = array();

        if (!$jobTitle == "") {
            if (!preg_match("/(\w[\s,\.\!]*){1,20}/", $jobTitle)) {
                if (strlen($jobTitle) > 21) {
                    array_push($errMsg, "Job Title", "Characters limit reach. Ensure that title is no more than 20 characters long");
                } else {
                    array_push($errMsg, "Title", "Only '.'(fullstop), ','(coma) and '!'(exclaimation mark) are allowed");
                }
            }
        }

        if (!file_exists($fileDir)) {
            array_push($errMsg, "404 File not found", "File does not exist. Please Create a job application or contact system admin");
        }
        if ($errMsg != array()) {
            include("include/header.php");
            echo displayErrMessage($errMsg);
            include("include/footer.php");
        } else {
            include("include/header.php");

            /*IF searchJobPosition HAS A VALUE. CHANGE IT TO
            STRING*/
            if (isset($_GET['searchJobPosition'])) {
                $searchJobPosition = implode($_GET['searchJobPosition']);
                echo "<p class='notice'>Result for: <strong>$searchJobPosition</strong></p>";
                echo displayJobVacancy($searchJobPosition, $fileDir, "/(\w{4}-\w{4})/");
            }

            /*IF searchJobPosition HAS A VALUE. CHANGE IT TO
            STRING*/
            if (isset($_GET['searchJobContract'])) {
                $searchJobContract = implode($_GET['searchJobContract']);
                echo "<p class='notice'>Result for: <strong>$searchJobContract</strong></p>";
                echo displayJobVacancy($searchJobContract, $fileDir, "/(On-going|Fixedterm)/");
            }

            /*IF searchJobPosition HAS A VALUE. CHANGE IT TO
            STRING*/
            if (isset($_GET['searchJobApplication'])) {
                $searchJobApplication = implode($_GET['searchJobApplication']);
                echo "<p class='notice'>Result for: <strong>$searchJobApplication</strong></p>";
                echo displayJobVacancy( $searchJobApplication, $fileDir,"/(Mail|Post)/");
            }

            if ($searchJobLocation) {
                echo "<p class='notice'>Result for: <strong>$searchJobLocation</strong></p>";
                echo displayJobVacancy($searchJobLocation, $fileDir, "/$searchJobLocation/");
            }
            
            if ($jobTitle) {
                echo "<p class='notice'>Result for: <strong>$jobTitle</strong></p>";
                echo displayJobVacancy($jobTitle, $fileDir, "/$jobTitle/");
            } else {
                echo "<p class='notice'><strong>Showing all result</strong></p>";
                echo displayJobVacancy("", $fileDir, "");
            }
            echo "<a class='button' href='searchjobform.php'>Back</a>";
            include("include/footer.php");
        }
    }
?>