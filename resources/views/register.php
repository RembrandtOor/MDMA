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
    <body>
        <div class="container flex-center h-100">
            <form method="POST" action="" class="login-container">
                <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
                <h1 class="text-center text-light">Create an account</h1>
                
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="first name">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirm" placeholder="confirm password">
                </div>

                <span>Already have an account? <a href="<?= route('login'); ?>">Login now.</a></span>

                <div class="btn-right">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
            </form>
        </div>
    </body>
</html>