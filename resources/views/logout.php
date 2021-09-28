<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA - logout</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <div class="container flex-center h-100">
        <a href="<?= route('index'); ?>" class="logo text-center">MDMA</a>
        <h1 class="text-center text-light">Logout</h1>
        <hr>
        <span>You have been successfully logged out.</span>
        <div class="btn-right">
            <button type="submit" class="btn btn-primary"><?= route('login'); ?>Click here to log in again</button>
        </div>
    </div>
</body>

</html>