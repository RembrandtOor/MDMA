<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Playlist</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/playlist.css">
    </head>
    <body>
        <div class="container">
            <div class="playlist-info">
                <img class="playlist-img" src="img/Compilation.jpg">
                <div class="playlist-details">
                    <div class="playlist-name"><?= $playlist->getName(); ?></div>
                    <span class="playlist-creator">By: <?= $playlist->getCreator(); ?></span>
                </div>
            </div>

            <div class="splitter"></div>

            <div class="search-bar">
                <input type="text class="search-input" placeholder="Search">
                <a class="add-song-btn" href="#">
                    <img src="img/plus-2.png">
                </a>
            </div>
            <div class="songs-list">
                <!-- <?php for($i=0; $i < 100; $i++):?>
                <div class="song">
                    <img class="song-img" src="img/images.jpeg">
                    <div class="song-details">
                        <div class="song-name">Thunderstruck</div>
                        <div class="song-author">AC/CD</div>
                    </div>
                    <div class="song-buttons">
                        <a href="#" class="star-btn">
                            <img src="img/star-<?= mt_rand(2,3) ?>.png">
                        </a>
                    </div>
                </div>
                <?php endfor ?> -->
            </div>
        </div>
    </body>
</html>