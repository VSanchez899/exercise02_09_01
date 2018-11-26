<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>College Internship</h1>
    <h2>Available Opportunities</h2>
    <?php
    if (isset($_REQUEST['internID'])) {
        $internID = $_REQUEST['internID'];
    } else {
        $internID = -1;
    }
    echo "\$internID: $internID\n";
    $errors = 0;
    $hostname = "localhost";
    $username = "adminer";
    $passwd = "judge-quick-25";
    $DBConnect = "false";
    $DBName = "internships1";
    if ($errors == 0) {
        $DBConnect = mysqli_connect($hostname, $username, $passwd);
        if (!$DBConnect) {
            ++$errors;
            echo "<p style='text-align: center;'>unable to connect to database server error code: " . mysqli_connect_error() . "</p>\n";
        }
        else {
            $result = mysqli_select_db($DBConnect, $DBName);
            if (!$result) {
                ++$errors;
                echo "<p style='text-align: center;'>unable to select the database \"$DBName\" error code: " . mysqli_connect_error() . "</p>\n";
        }
        }
    }
    $TableName = "interns";
    if ($errors == 0) {
        $SQLstring = "SELECT * FROM $TableName" . 
        " WHERE internID='$internID'";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (!$queryResult) {
            ++$errors;
            echo "<p>Unable to execute the query, error code: " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
        }
        else {
            if (mysqli_num_rows($queryResult) == 0) {
                ++$errors;
                echo "<p>Invalid Intern ID!</p>";
            }
        }
    }
    if ($errors == 0) {
        $row = mysqli_fetch_assoc($queryResult);
        $internName = $row['first'] . " " . $row['last'];
    }
    else {
        $internName = "";
    }
    echo "<p>\$internName: $internName</p>\n";
    $TableName = "assigned_opportunities";
    if ($errors == 0) {
        $SQLstring = "SELECT COUNT(opportunityID)" . 
        " FROM $TableName" . 
        " WHERE internID ='$internID'" . 
        " AND dateApproved IS NOT NULL";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (mysqli_num_rows($queryResult) > 0) {
            $row = mysqli_fetch_row($queryResult);
            $approvedOpportunities = $row[0];
            mysqli_free_result($queryResult);
        }
        $selectedOpportunities = array();
        $SQLstring = "SELECT opportunityID FROM $TableName" . 
        " WHERE internID='$internID'";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (mysqli_num_rows($queryResult) > 0) {
            while (($row = mysqli_fetch_row($queryResult)) != false) {
                $selectedOpportunities[] = $row[0];
            }
            mysqli_free_result($queryResult);
        }
        $assignedOpportunities = array();
        $SQLstring = "SELECT opportunityID FROM $TableName" . 
        " WHERE internID='$internID'";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (mysqli_num_rows($queryResult) > 0) {
            while (($row = mysqli_fetch_row($queryResult)) != false) {
                $assignedOpportunities[] = $row[0];
            }
            mysqli_free_result($queryResult);
        }
        $TableName = "opportunities";
        $opportunities = array();
        $SQLstring = "SELECT opportunityID, company, city," . 
        " startDate, endDate, position, description" . 
        " FROM $TableName";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (mysqli_num_rows($queryResult) > 0) {
            while (($row = mysqli_fetch_assoc($queryResult)) != false) {
                $opportunities[] = $row;
            }
            mysqli_free_result($queryResult);
        }
        echo "<pre>\n";
        print_r($opportunities);
        echo "</pre>\n";
         
    }


    if ($DBConnect) {
        echo "<p style='text-align: center;'>closing Database \"$DBName\" connection.</p>\n";
        mysqli_close($DBConnect);
        }
        echo "<table border='1' width='100%'>\n";
        echo "<p><a href='InternLogin.php'>Log Out</a></p>\n";
        echo "</table>";
    ?>
    </body>
</html>