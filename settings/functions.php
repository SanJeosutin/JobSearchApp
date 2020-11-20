<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : functions.php
    *? DESCRIPTION : custom functions that will be 
    *?               used throughout the assignment
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 10-09-2020
    *********************************************/
    /*CLEAN USER'S INPUT*/
    function sanitisedInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /*CLEAN TEXT FIELD FOR jobs.txt*/
    function cleanTextField($paragraph){
        $paragraph = preg_replace('/\s\s+/', '\n', $paragraph);
        $paragraph = "\"$paragraph\"";
        return $paragraph;
    }

    /*CHECK IF ID IS SAME*/
    function isPosIDExist($data, $fileDir){
        $openFile = fopen($fileDir, "r");

        while(!feof($openFile)){
            /*get position id start at pos: 0 and search to 5 characters long*/
            $eachPostID = substr(fgets($openFile), 0, 5);
            if($eachPostID === $data){
                return true;
            }
        }
        fclose($openFile);
        return false;
    }

    /*DISPLAY NEXT POSITION ID*/
    function showNextPosID($fileDir, $dir){
        /*CHECK IF FILE EXIST. IF NOT CREATE ONE*/
        if(!file_exists($fileDir)){
            umask(0007);
            
            /*CHECK IF DIR EXIST. IF NOT CREATE ONE*/
            if(!file_exists($dir))
                mkdir($dir, 02770);

            $fileOpen = fopen($fileDir, "w");
            fclose($fileOpen);
        }

        $count = 0;
        $openFile = fopen($fileDir, "r");

        while(!feof($openFile)){
            /*get position id start at pos: 1 and search to 4 characters long*/
            $getLastID = substr(fgets($openFile), 1, 4);
            /*if $count is less than or equal to the last $posID add one
            else add the value together and return it as the formated string*/

            if($count <= intval($getLastID)){
                $count++;
            }else{
                $value = $getLastID + $count;
                return "P".strval(sprintf("%'.04d\n", $value));
            }
        }
        fclose($openFile);
    }

    /*DISPLAY ERROR MESSAGE*/
    function displayErrMessage($errMsg){
        $dataAmount = count($errMsg);
        $fieldName = array();
        $reason = array();
        $data = "";
        /*
        SPLIT $errMsg INTO 2 SEPERATE DATA / ARRAY:
            -$fieldName
            -$reason
        */
        //*FIELD NAME
        for($i=0; $i < $dataAmount; $i+=2){
            array_push($fieldName, $errMsg[$i]);
        }

        //*REASON
        for($i=1; $i < $dataAmount; $i+=2){
            array_push($reason, $errMsg[$i]);
        }

        /*
        NEATLY PUT THE ERROR CODE BACK INTO A 
        READABLE HTML FORMAT
        */
        for($i=0; $i < count($reason); $i++){
            $data .= "
            <li>
                <p><strong>".$fieldName[$i].":</strong></p>
                <ul><li><p><em>".$reason[$i].".</em></p></li></ul>
            </li>";
        }

        $displayError = "<nav class='errorBox'>
        <h3><strong>Cannot procces request.</strong></h3>
        <h4><em>The following need to changed:</em></h4>
        <ul>
            ".$data."
        </ul>
        </nav>
        ";
        return $displayError;
    }

    /*FUNCTION 'BOROWED' FROM: https://www.geeksforgeeks.org/sort-array-dates-php/ */
    function sortDate($date1, $date2)
    {
        echo "UNIX:<br>";
        echo "DeadLine: $date1<br>Date Now: $date2<br><br>";
        echo "DeadLine: ".strtotime(str_replace('/','-',$date1))."<br>Date Now:".strtotime(str_replace('/','-',$date2))."<hr>";
        /*convert date to unix timestamp and compare it*/
        if (strtotime(str_replace('/','-',$date1)) < strtotime(str_replace('/','-',$date2))) {
            return false;
        } elseif (strtotime(str_replace('/','-',$date1)) > strtotime(str_replace('/','-',$date2))) {
            return true;
        }
    }

    function temp_sortDate($deadLine, $currDate){
        $arrDeadLine = explode("/", $deadLine);
        $arrcurrDate = explode("/", $currDate);

        if($arrcurrDate[2] > $arrDeadLine[2]){
            return false;
        }else{
            return true;
        }
    }
    

    /*DISPLAY JOB VACANCY AT searchjobprocess.php*/
    function displayJobVacancy($findString, $fileDir, $regex){
        /*
        sanitised the input, put input to lower case, get the
        1st character to capitalized for each words
        */
        $currentDate = date("d/m/y");
        $findString = ucwords(strtolower(sanitisedInput($findString)));
        $eachLineData = "";
        $handle = fopen($fileDir, "r");

        if(is_readable($fileDir)){
            while(!feof($handle)){
                /*make a List with the following var*/                                                                       /*set the last line on file with value null*/
                $listData = list($posID, $jobTitle, $jobDesc, $jobClosingDate, $jobPosition, $jobContract, $jobAcceptBy, $jobLocation) = array_pad(explode("\t", fgets($handle)), 8, null);
                /*check current time with $jobClosingDate*/
                if(temp_sortDate($jobClosingDate, $currentDate)) {
                    /*
                    put $listData as 'an array' and loop through each list
                    ie: $posID then $jobTitle then $jobDesc etc
                    */
                    if ($findString != "") {
                        foreach ($listData as $data) {
                            /*
                            if regex matches with $data from the List
                            then check the actual string with it's own matching type
                            ie: if user select 'Position: Full Time', get matching regex
                            that correspond to 'Position' and search the value from
                            file.
                            */
                            if (preg_match($regex, $data)) {
                                /*used '(?i) to ignore case sensitive'*/
                                if (preg_match("/(?i)$findString/", $data)) {
                                    $eachLineData .= "
                                    <nav class=\"result\">
                                    <p class=\"title\"><strong>".$jobTitle."</strong></p>
                                    <p><strong> Description: </strong>".$jobDesc."</p>
                                    <p><strong> Closing Date: </strong>".$jobClosingDate."</p>
                                    <p><strong> Position: </strong>".$jobPosition."</p>
                                    <p><strong> Contract: </strong>".$jobContract."</p>
                                    <p><strong> Apply by: </strong>".$jobAcceptBy."</p>
                                    <p><strong> Location: </strong>".$jobLocation."</p>
                                    </nav>
                                    <hr>
                                    ";
                                }
                            }
                        }
                    } elseif ($findString == "") {
                        /*
                        check if $posID is not EMPTY. If so print all
                        the data except the new empty line
                        */
                        if ($posID != null) {
                            $eachLineData .= "
                            <nav class=\"result\">
                            <p class=\"title\"><strong>".$jobTitle."</strong></p>
                            <p><strong> Description: </strong>".$jobDesc."</p>
                            <p><strong> Closing Date: </strong>".$jobClosingDate."</p>
                            <p><strong> Position: </strong>".$jobPosition."</p>
                            <p><strong> Contract: </strong>".$jobContract."</p>
                            <p><strong> Apply by: </strong>".$jobAcceptBy."</p>
                            <p><strong> Location: </strong>".$jobLocation."</p>
                            </nav>
                            <hr>
                            ";
                        }
                    }
                }
            }
            fclose($handle);
        }
        /*if $eachLineData is not empty. Spit the result out.*/
        if($eachLineData != ""){
            $headingTitle = "<h3><strong>We found the following result in our database.</strong></h3>";
        }else{
            /*Else warn user with the following message*/
            $headingTitle = "<h3><strong>We cannot found any result in our database.</strong></h3>";
            $eachLineData = "<p>Please try checking your spelling and or contact system admin if problem persist.</p>";
        }
        return $headingTitle.$eachLineData;
    }
?>
