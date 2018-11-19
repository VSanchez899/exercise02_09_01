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
        $rows = mysqli_fetch_assoc($queryResult);
        $internName = $row['first'] . " " . $row['last'];
    }
    else {
        echo "\$internName: $internName";
        if ($DBConnect) {
            echo "<p style='text-align: center;'>closing Database \"$DBName\" connection.</p>\n";
            mysqli_close($DBConnect);
        }
    }
    
    ?>
    </body>
</html>