<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA - register</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<? require "navbar.php"?>

<body>

    <div class="register-container">

        <h1>Register</h1>

        <form action="" method="POST">

            <div class="form-item">
                <label for="firstname">First Name:</label>
                <input type="text" name="firstname" id="firstname">
            </div>

            <div class="form-item">
                <label for="firstname">User Name:</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="form-item">
                <label for="firstname">Email:</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="form-item">
                <label for="firstname">Password:</label>
                <input type="text" name="password" id="password">
            </div>

            <div class="form-item">
                <label for="firstname">Retype Password:</label>
                <input type="text" name="repassword" id="repassword">
            </div>

            <div class="btn-item">
                <input class="register-btn" type="submit" value="Create account">
            </div>
        </div>

    </form>
      
</body>
</html>