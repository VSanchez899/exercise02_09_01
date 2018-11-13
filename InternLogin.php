<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <h1>College Interships</h1>
    <h2>Register / Login</h2>
    <p>new interns, please complete the top form to register as a user. Returning users, please complete the second form to login.</p>
    <h3>New intern Registration</h3>
    <form action="Registration.php" method="post">
        <p>Enter your name: First
            <input type="text" name="first">
            last:
            <input type="text" name="last">
        </p>
        <p>
            Enter your email address:
            <input type="text" name="email">
        </p>
        <p>
            Enter a password for your account:
                <input type="password" name="password">
        </p>
        <p>
            Confirm your password
                <input type="password" name="password2">
        </p>
        <p><em>(Passwords are case-sensitive and must be at least 6 charaters long.)</em></p>
        <input type="reset" name="reset" value="Reset Registration Form">
        <input type="submit" name="register" value="Register">
    </form>


    <h3>Returning intern Login</h3>
    <form action="verifyLogin.php" method="post">
        <p>
            Enter your email address:
            <input type="text" name="email">
        </p>
        <p>
            Enter your password for your account:
                <input type="password" name="password">
        </p>
        <p><em>(Passwords are case-sensitive and must be at least 6 charaters long.)</em></p>
        <input type="reset" name="reset" value="Reset Login">
        <input type="submit" name="register" value="Login">
    </form>

    </body>
</html>