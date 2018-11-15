<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Intern Login</title>
</head>
<body>
    <h1 style='text-align: center;'>College Internship</h1>
    <h2 style='text-align: center;'>Verify Intern Login</h2>
    <?php

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
        $SQLstring = "SELECT internID, first, last" .
        " FROM $TableName" . 
        " WHERE email='" . stripslashes($_POST['email']) . 
        "' AND password_md5='" . 
        md5(stripslashes($_POST['password'])) . "'";
        $queryResult = mysqli_query($DBConnect, $SQLstring);
        if (!$queryResult) {
            ++$errors;
            echo "<p style='text-align: center;'>SQL Syntax error</p>";
        }
    }
    if ($DBConnect) {
        echo "<p style='text-align: center;'>closing Database \"$DBName\" connection.</p>\n";
        mysqli_close($DBConnect);
    }
    if ($errors > 0) {
        echo "<p style='text-align: center;'>Please use your browser's BACK button to return to the form and fix the errors indicated</p>";
    }

    ?>
</body>
</html>