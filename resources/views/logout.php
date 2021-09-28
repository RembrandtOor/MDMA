<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA - logout</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/playlist.css">

</head>

<body>
    <div class="container flex-center h-100">
        <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
        <h1 class="text-left text-light">Logout</h1>
        <div class="splitter"></div>
        <h2>You have been successfully logged out.</h2>
        <br>
        <div class="btn-right">
            <a href="<?= route('login') ?>" class="btn btn-primary btn-xS">Click here to log in again</a>
        </div>
    </div>
</body>

</html>