<?php
    /*********************************************
    *? NAME        : SanJeosutin
    *? TITLE       : postjobform.php
    *? DESCRIPTION : User can post job on this page. 
    *? CREATED ON  : 20-08-2020
    *? EDITED ON   : 26-08-2020
    *********************************************/
    include("settings/functions.php");
    include("settings/config.php");
    $currentDate = date("d/m/y");
    $nextValue = showNextPosID($fileDir, $dir);
?>
<?php include("include/header.php"); ?>
<h2>Post a Job</h2>
<form method="post" action="postjobprocess.php">
    <table>
        <tr>
            <td>
                <p>
                    <label for="posID"><strong>Position ID:</strong></label><br />
                    <input type="text" name="posID" id="posID" value="<?php echo $nextValue; ?>">
                </p>
                <p>
                    <label for="jobTitle"><strong>Title:</strong></label><br />
                    <input type="text" name="jobTitle" id="jobTitle">
                </p>
                <p>
                    <label for="jobDescription"><strong>Comments:</strong></label><br />
                    <textarea name="jobDescription" id="jobDescription" rows="4" cols="40"></textarea>
                </p>
                <p>
                    <label for="jobClosingDate"><strong>Closing Date:</strong></label><br />
                    <input type="text" name="jobClosingDate" id="jobClosingDate" value="<?php echo $currentDate;?>">
                </p>
            </td>
            <td>
                <p>
                    <strong>Position: </strong><br />
                    <input type="radio" id="fullTime" name="jobPosition" value="Full-time">
                    <label for="fullTime">Full Time</label>
                    <input type="radio" id="partTime" name="jobPosition" value="Part-time">
                    <label for="partTime">Part Time</label>
                </p>
                <p>
                    <strong>Contract: </strong><br />
                    <input type="radio" id="ongoing" name="jobContract" value="On-going">
                    <label for="ongoing">On-going</label>
                    <input type="radio" id="fixedterm" name="jobContract" value="Fixedterm">
                    <label for="fixedterm">Fixed Term</label>
                </p>
                <p>
                    <strong>Accept Application by: </strong><br />
                    <input type="checkbox" id="post" name="jobApplication[]" value="Post">
                    <label for="post">Post</label>
                    <input type="checkbox" id="mail" name="jobApplication[]" value="Mail">
                    <label for="mail">Mail</label>
                </p>
                <p>
                    <label for="jobLocation"><strong>Location: </strong></label><br />
                    <select name="jobLocation" id="jobLocation">
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
            </td>
        </tr>
    </table>
    <input type="submit" name="postForm" value="Post">
    <input type="reset" name="resetForm" value="reset">
</form>
<?php include("include/footer.php"); ?>
