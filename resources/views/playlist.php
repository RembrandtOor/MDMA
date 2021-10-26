<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Playlist</title>
        <link rel="stylesheet" href="<?= asset('css/styles.css'); ?>">
        <link rel="stylesheet" href="<?= asset('css/playlists.css'); ?>">
        <link rel="stylesheet" href="<?= asset('css/playlist.css'); ?>">
        <link href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" rel="stylesheet">
    </head>
    <body>
        <?php view('components.navbar'); ?>

        <div class="container">
            <div style="margin-bottom: 10px;">
                <a href="<?= route('playlists') ?>" class="btn btn-primary"><- Go back</a>
            </div>
            <div class="playlist-info">
                <img class="playlist-img" src="<?= $playlist->getIconUrl(); ?>">
                <div class="playlist-details">
                    <div class="playlist-name"><?= $playlist->getName(); ?></div>
                    <span class="playlist-creator">By: <?= $playlist->getCreator(); ?></span>
                </div>
            </div>

            <div>
                <button id="play-playlist" class="btn btn-lg btn-circle btn-icon btn-primary" data-playlist-id="<?= $playlist->getId(); ?>">
                    <img src="/img/icons/play" heigth="18px" width="18px">
                </button>
            </div>

            <div class="splitter"></div>

            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search">
                <!-- <button id="add-song" class="btn btn-circle btn-transparent add-playlist-btn">
                    <img src="img/plus-2.png">
                </button> -->
            </div>

            <div class="songs-list">
                <?php foreach($songs as $song): ?>
                    <div class="song">
                        <div class="song-img">
                            <img src="<?= $song->getIconUrl() ?>">
                            <div class="song-img-hover">
                                <button class="btn btn-circle btn-transparent btn-icon play-song" data-song='<?= json_encode($song->getSongData()) ?>'>
                                    <img src="<?= asset('img/icons/play.png') ?>" />
                                </button>
                            </div>
                        </div>
                        <div class="song-details">
                            <div class="song-name"><?= $song->getName() ?></div>
                            <div class="song-author"><?= $song->artist()->getName() ?></div>
                        </div>
                        <div class="song-buttons">
                            <a href="#" class="star-btn">
                                <img src="<?= asset('img/star-'.mt_rand(2,3).'.png') ?>">
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <script src="<?= asset('js/main.js') ?>"></script>
    </body>
</html>