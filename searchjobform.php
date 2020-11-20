<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : jobpostform.php
    *? DESCRIPTION : Main content of the web application. 
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 03-09-2020
    *********************************************/
?>
<?php include("include/header.php"); ?>
    <h2>Search Jobs</h2>
    <form method="get" action="searchjobprocess.php">
                <p>
                    <label for="findJob"><strong>Job Title:</strong></label><br />
                    <input type="text" name="findJob" id="findJob">
                </p>
                <nav class="searchJob">
                    <p>
                        <strong>Position: </strong><br />
                        <input type="radio" id="fullTime" name="searchJobPosition[]" value="Full-time">
                        <label for="fullTime">Full Time</label>
                        <input type="radio" id="partTime" name="searchJobPosition[]" value="Part-time">
                        <label for="partTime">Part Time</label>
                    </p>
                    <p>
                        <strong>Contract: </strong><br />
                        <input type="radio" id="ongoing" name="searchJobContract[]" value="On-going">
                        <label for="ongoing">On-going</label>
                        <input type="radio" id="fixedterm" name="searchJobContract[]" value="Fixedterm">
                        <label for="fixedterm">Fixed Term</label>
                    </p>
                    <p>
                        <strong>Accept Application by: </strong><br />
                        <input type="checkbox" id="post" name="searchJobApplication[]" value="Post">
                        <label for="post">Post</label>
                        <input type="checkbox" id="mail" name="searchJobApplication[]" value="Mail">
                        <label for="mail">Mail</label>
                    </p>
                    <p>
                        <label for="jobLocation"><strong>Location: </strong></label><br />
                    <select name="searchJobLocation" id="jobLocation">
                        <option value="">---</option>
                        <option value="Victoria">VIC</option>
                        <option value="New South Wales">NSW</option>
                        <option value="Queensland">QLD</option>
                        <option value="Northern Territory">NT</option>
                        <option value="Western Australia">WA</option>
                        <option value="South Australia">SA</option>
                        <option value="Tasmania">TAS</option>
                        <option value="Australian Capital Territory">ACT</option>
                    </select>
                </p>
            </nav>
            <br />
                <input type="submit" name="submit" value="Search Job">
                <input type="reset" name="reset" value="reset">
            </form>
<?php include("include/footer.php"); ?>