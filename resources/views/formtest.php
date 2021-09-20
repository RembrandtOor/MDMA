<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA</title>
</head>
<body>
    <?php require_once 'navbar.php';?>

    <h1>Form test</h1>

    <form method="post" action="<?= route('/api/testform') ?>">
        <input type="text" name="search" placeholder="Search">

        <button type="submit">Submit</button>
    </form>
</body>
</html>