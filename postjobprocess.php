<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : postjobprocess.php
    *? DESCRIPTION : Processing job that are submited from postjobform.php
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 02-09-2020
    *********************************************/
    include("settings/functions.php");
    include("settings/config.php");
    $errMsg = array();
    
    /*RETURN USER TO index WHEN THEY INSERT THE DIRECT URL*/
    if(!isset($_POST["postForm"])){
        header("location: index.php");
        exit();
    }else{
        /*
        SANITISED USER INPUT USING FUNCTION FROM 'functions.php'
        AND PUT THE SANITISED INPUT AS A VARIABLE
        */
        $positionID = sanitisedInput($_POST['posID']);
        $jobTitle = sanitisedInput($_POST['jobTitle']);
        $jobDescription = sanitisedInput($_POST['jobDescription']);
        $jobClosingDate = sanitisedInput($_POST['jobClosingDate']);
        $jobLocation = sanitisedInput($_POST['jobLocation']);

        $jobDescription = cleanTextField($jobDescription);

        /*CHECK ALL INPUT. IF VIOLATED, ERROR WILL BE RECORDED INSIDE $errMsg ARRAY*/
        if($positionID == ""){
            array_push($errMsg, "Position ID", "Cannot be empty");
        }elseif(!preg_match("/^(P\d{4})$/", $positionID)){
            array_push($errMsg, "Position ID", "Wrong format. Must have 'P' and follow by 4 digits");
        }

        if($jobTitle == ""){
            array_push($errMsg, "Title", "Cannot be empty");
        }elseif(!preg_match("/^(\w[\s,\.\!]*){1,20}$/",$jobTitle)){
            if(strlen($jobTitle) > 21){
                array_push($errMsg, "Title", "Characters limit reach. Ensure that title is no more than 20 characters long");
            }else{
                array_push($errMsg, "Title", "Only '.'(fullstop), ','(coma) and '!'(exclaimation mark) are allowed");
            }
        }

        if($jobDescription == ""){
            array_push($errMsg, "Description", "Cannot be empty");
        }elseif(strlen($jobDescription) > 261){
            array_push($errMsg, "Description", "Characters limit reach. Ensure that description is no more than 260 characters long");
        }

        if ($jobClosingDate == "") {
            array_push($errMsg, "Closing Date", "Cannot be empty");
        }elseif(!preg_match("/^((3[0|1]|2\d|1\d|0\d|[1-9])\/(1[0-2]|0\d|[1-9])\/(\d{2}))$/", $jobClosingDate)){
            array_push($errMsg, "Closing Date", "Wrong date format. Format must be 'dd/mm/yy'. dd- day, mm- month, yy- last 2 digits of the year");
        }

        if(isset($_POST['jobPosition'])){ 
            $jobPosition = $_POST['jobPosition']; 
        }else{
            array_push($errMsg, "Position", "Cannot be blank");
        }

        if(isset($_POST['jobContract'])){ 
            $jobContract = $_POST['jobContract']; 
        }else{ 
            array_push($errMsg, "Contract", "Cannot be blank");
        }

        if(isset($_POST['jobApplication'])){ 
            $jobAcceptApplication = $_POST['jobApplication']; 
        }else{ 
            array_push($errMsg, "Position", "Cannot be blank");
        }
        
        if($jobLocation == ""){
            array_push($errMsg, "Location", "Cannot be blank");
        }

        /*CHECK IF FILE EXIST. IF NOT CREATE ONE*/
        if(!file_exists($fileDir)){
            umask(0007);
            
            /*CHECK IF DIR EXIST. IF NOT CREATE ONE*/
            if(!file_exists($dir))
                mkdir($dir, 02770);

            $fileOpen = fopen($fileDir, "w");
            fclose($fileOpen);
        }

        if(isPosIDExist($positionID, $fileDir)){ 
            array_push($errMsg, "Position ID", "Found duplicate. Please try another ID");
        }

        /*DISPLAY / PROCCESS THE OUTCOME*/
        if($errMsg != array()){
            include("include/header.php");
            echo displayErrMessage($errMsg);
            echo "<a class='button' href='postjobform.php'>Back</a>";
            include("include/footer.php");
        }else{
            include("include/header.php");
            echo "<h2>successfully added your request with the following criteria.</h2>";
            echo"
                <nav class=\"result\">
                    <p><strong> Position ID:</strong> ".$positionID."</p>
                    <p><strong> Job title:</strong> ".$jobTitle."</p>
                    <p><strong> Description: </strong> ".$jobDescription."</p>
                    <p><strong> Closing Date: </strong> ".$jobClosingDate."</p>
                    <p><strong> Position: </strong> ".$jobPosition."</p>
                    <p><strong> Contract: </strong> ".$jobContract."</p>
                    <p><strong> Apply by: </strong> ".implode(", " ,$jobAcceptApplication)."</p>
                    <p><strong> Location: </strong> ".$jobLocation."</p>
                </nav>
            "; 
            echo "<a class='button' href='postjobform.php'>Back</a>";
            include("include/footer.php");
                                            /*PUT ALL VALUE TO LOWER CASE, THEN CAPITALIZED THE 1ST CHAR OF EACH WORD*/
            $postJobData = $positionID."\t".ucwords(strtolower($jobTitle))."\t".$jobDescription."\t".$jobClosingDate."\t".$jobPosition."\t".$jobContract."\t".implode(", " ,$jobAcceptApplication)."\t".$jobLocation."\n"; 
            $openFile = fopen($fileDir, "a+");
            fwrite($openFile, $postJobData);
            fclose($openFile);
        }
        /*CLEAR $errMsg ARRAY*/
        unset($errMsg);
    }
?>
