<!DOCTYPE html>
<html lang="en" style="background-color: grey;">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1 style="text-align: center;">College Intership</h1>
    <h2 style="text-align: center;">Intern Registration</h2>
    <?php
    $errors = 0;
    $email = "";
    $hostname = "localhost";
    $username = "adminer";
    $passwd = "judge-quick-25";
    $DBConnect = false;
    $DBName = "internships1";
    
    if (empty($_POST['email'])) {
        ++$errors;
        echo "<p style='text-align: center;'>You need to enter an e-mail address</p>\n";
    }
    else{
        $email = stripslashes($_POST['email']);
        if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[w-]+)*(\.[A-Za-z]{2,})$/i", $email) == 0) {
            ++$errors;
            echo "<p style='text-align: center;'>You need to enter a valid e-mail address.</p>\n";
            $email = "";
        }
        
    }
    if (empty($_POST['password'])) {
        ++$errors;
        echo "<p style='text-align: center;'>You need to enter a password</p>\n";
    }
    else{
        $password = stripslashes($_POST['password']);
        }
        
    if (empty($_POST['password2'])) {
        ++$errors;
        echo "<p style='text-align: center;'>You need to Confirm password</p>\n";
        }
    else{
        $password2 = stripslashes($_POST['password2']);
        }
        if (!empty($password) && !empty($password2)) {
            if (strlen($password) < 6) {
                ++$errors;
                echo "<p style='text-align: center;'>The password is too short</p>\n";
                $password = "";
                $password2 = "";
            }
            if ($password <> $password2) {
                ++$errors;
                echo "<p style='text-align: center;'>The password do not match</p>\n";
                $password = "";
                $password2 = "";
            }
        }

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
                } else {
                    
                }
                
                
            }
            $TableName = "interns";
            if ($errors == 0) {
                $first = stripslashes($_POST['first']);
                $last = stripslashes($_POST['last']);
                $SQLstring = "INSERT INTO $TableName" .
                " (first, last, email, password_md5)" .
                " VALUES('$first', '$last', '$email', " . 
                "'" . md5($password) . "')";
                $queryResult = mysqli_query($DBConnect, $SQLstring);
                if (!$queryResult) {
                    ++$errors;
                    echo "<p style='text-align: center;'>unable to save your registration error code: " . mysqli_error($DBConnect) . "</p>\n";
                }
                else {
                    $internID = mysqli_insert_id($DBConnect);
                }
                echo "<p style='text-align: center;'>closing Database \"$DBName\" connection.</p>\n";
                mysqli_close($DBConnect);
            }
        }
    
        if ($errors > 0) {
            echo "<p style='text-align: center;'>Please use your browser's BACK button to return to the form and fix the errors indicated</p>";
        }
    ?>
    </body>
</html>