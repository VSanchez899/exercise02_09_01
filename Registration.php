<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>College Intership</h1>
    <h2>Intern Registration</h2>
    <?php
    $errors = 0;
    $email = "";
    if (empty($_POST['email'])) {
        ++$errors;
        echo "<p>You need to enter an e-mail address</p>\n";
    }
    else{
        $email = stripslashes($_POST['email']);
        if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[w-]+)*(\.[A-Za-z]{2,})$/i", $email) == 0) {
            ++$errors;
            echo "<p>You need to enter a valid e-mail address.</p>\n";
            $email = "";
        }
        
    }
    if (empty($_POST['password'])) {
        ++$errors;
        echo "<p>You need to enter a password</p>\n";
    }
    else{
        $password = stripslashes($_POST['password']);
        }
        
    if (empty($_POST['password2'])) {
        ++$errors;
        echo "<p>You need to Confirm password</p>\n";
        }
    else{
        $password2 = stripslashes($_POST['password2']);
        }
        if (!empty($password && !empty($password2))) {
            if (strlen($password) < 6) {
                ++$errors;
                echo "<p>The password is too short</p>\n";
                $password = "";
                $password2 = "";
            }
            if ($password <> $password2) {
                ++$errors;
                echo "<p>The password do not match</p>\n";
                $password = "";
                $password2 = "";
            }
        }
        if ($errors > 0) {
            echo "<p>Please use your browser's BACK button to return to the form and fix the errirs indicated</p>";
        }
    ?>
    </body>
</html>