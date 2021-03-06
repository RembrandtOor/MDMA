<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Login</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/register.css">
        <link href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container flex-center h-100">
            <form method="POST" action="" class="login-container" id="login-form">
                <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
                <h1 class="text-center text-light">Login</h1>
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                </div>

                <span>Don't have an account yet? <a href="<?= route('register'); ?>">Register now.</a></span>

                <div class="btn-right">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>

        <script src="<?= asset('js/main.js') ?>"></script>
    </body>
</html>