<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Group</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/playlist.css">
    </head>
    <body>
        <div class="container">
            <div class="playlist-info">
                <img class="playlist-img" src="img/4A9A_group.png">
                <div class="playlist-details">
                    <div class="playlist-name"><?= $group->getName(); ?></div>
<!--                     <span class="playlist-creator">By: <?= $group->getCreator(); ?></span> -->
                </div>
            </div>

            <div class="splitter"></div>

            <div class="search-bar">
                <!-- <input type="text class="search-input" placeholder="Search">
                <a class="add-song-btn" href="addsong.php">
                    <img src="img/plus-2.png">
                </a> -->
                <h2> Members </h2>
                <ul>
                    <li>Momen</li>
                    <li>Daniel</li>
                    <li>Hani</li>
                    <li>Rembrandt</li>
                    <li>Lawrens</li>
                    <li>Hector</li>
                </ul>
            </div>
        </div>
    </body>
</html>