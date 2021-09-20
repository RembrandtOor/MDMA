<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA</title>
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
</head>
<body>
    <?php require_once 'navbar.php';?>

    <h2>Songs</h2>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($songs as $song){?>
                <tr>
                    <td><?= $song->id; ?></td>
                    <td><?= $song->name; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>