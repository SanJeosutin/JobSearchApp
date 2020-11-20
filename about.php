<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : jobpostform.php
    *? DESCRIPTION : About content. 
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 10-09-2020
    *********************************************/
?>
<?php include("include/header.php"); 

echo "
    <h2>About This Assignment</h2>
    <nav class='display'>
        <p><strong>PHP Version: </strong>".phpversion()."</p>
        <br/>
        <p><strong>Task that are not attempted or completed?</strong></p>
        <ul>
            <li>Task 8 A -Sort by date. <em>as of 10/09/2020 - 16:56PM</em>
            </li>
        </ul>
        <br/>
        <p><strong>Special Features?</strong></p>
        <ul>
            <li>Show fresh ID for Position ID</li>
            <li>Auto capitalised search result</li>
            <li>Have a reuseable 'error handling' system.</li>
            <li>Split 'header.php' & 'footer.php'</li>
            <li>Have a 'functions.php' to handle most of the work</li>
            <li>Changes navigation button depends on where the user are in the website.</li>
        </ul>
        <br/>
        <p><strong>What discussion points did you participated on in the unit’s discussion board for Assignment 1?</strong></p>
        <ul>
            <li>I've participated on <a href='https://swinburne.instructure.com/courses/29943/discussion_topics/437190'>Assignment 1 - Styling Discussion</a>
            .I've talked about how and when I did my styling.</li>
            <li>The other one was about a question that someone asked weather the date need to be text input or not. And how they can get the 'today`s' date to 
            showed inside the input box</li>
        </ul>
        <br/>
        <img src='contribution/Capture.PNG' alt='Contribution1'>
        <br/>
        <img src='contribution/Capture2.PNG' alt='Contribution2'>
    </nav>
";
 include("include/footer.php"); ?>