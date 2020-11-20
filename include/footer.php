<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : footer.php
    *? DESCRIPTION : Display buttons / links to other web pages.
    *?               Same functionality as header.php , keep the 
    *?               web application well structured. 
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 24-08-2020
    *********************************************/
    /*GET CURRENT PAGE, STORE PAGE NAMES AND BUTTON NAMES AS ARRAY*/
    $currLocation = basename($_SERVER['PHP_SELF']);
    $arrHrefs = array("index.php", "postjobform.php", "about.php", "searchjobform.php");
    $arrBtnNames = array("Index", "Post Job", "About This Assigment", "Search Jobs");
?>

</nav>
    </nav>
    <nav class="navButtons">
        <?php
            /*
            CHECK IF CURRENT LOCATION MATCHES WITH THE FOLLOWING.
            IF SO, REMOVED THE PAGE HREF AND BUTTON NAME THAT ARE
            CORRESPOND TO EACH PAGE.
    
            IE:
                  remove     |    array   | index | lenght |
                -array_splice(  $arrHrefs ,   0   ,   1    );
                -array_splice($arrBtnNames,   0   ,   1    );
                
            */
            if($currLocation == "index.php"){
                array_splice($arrHrefs, 0, 1);
                array_splice($arrBtnNames, 0, 1);
            }elseif($currLocation == "postjobform.php" || $currLocation == "postjobprocess.php" ){
                array_splice($arrHrefs, 1, 1);
                array_splice($arrBtnNames, 1, 1);
            }elseif($currLocation == "about.php"){
                array_splice($arrHrefs, 2, 1);
                array_splice($arrBtnNames, 2, 1);
            }elseif($currLocation == "searchjobform.php"   || $currLocation == "searchjobprocess.php"){
                array_splice($arrHrefs, 3, 1);
                array_splice($arrBtnNames, 3, 1);
            }else{
                echo "<p>ERROR! PAGE COULD NOT BE FOUND</p>";
            }
        
            /*
            DISPLAY THE BUTTONS AND LINK THEM TO THEIR 
            APPROPRIATE PAGES
            */
            for($i=0; $i<count($arrHrefs); $i++){
                echo $arrNewLinks = "<a href='$arrHrefs[$i]'>$arrBtnNames[$i]</a>";
            }
        ?>
    </nav>
</body>
</html>