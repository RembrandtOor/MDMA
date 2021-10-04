</body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Playlist</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/playlists.css">
        <link href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" rel="stylesheet">
    </head>
    <body>
        <?php view('components.navbar'); ?>

        <?php if(count($playlists) == 0): ?>
            <div class="content">
                <div class="logo">MDMA</div>
                <h1>You have no &#160;<span class="text-secondary">playlists &#160;</span> yet!</h1>
                <a href="<?= route('login') ?>" class="btn btn-primary btn-xS">+ CREATE PLAYLIST</a>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="search-bar">
                    <input type="text class="search-input" placeholder="Search">
                    <a class="add-playlist-btn" href="#">
                        <img src="img/plus-2.png">
                    </a>
                </div>

                <h1 class="text-center">Playlists</h1>
                <div class="splitter"></div>

                <div class="playlist-list">
                    <?php foreach($playlists as $playlist):?>
                        <div class="playlist">
                            <img class="playlist-img" src="<?= $playlist->getIconUrl() ?>">
                            <div class="playlist-details">
                                <a class="playlist-name" href="<?= route('playlist', ['id' => $playlist->getId()]); ?>"><?= $playlist->getName() ?></a>
                                <!-- <div class="playlist-author">Group name</div> -->
                            </div>
                            <div class="playlist-buttons">
                                <a href="#" class="icon-btn">
                                    <img src="img/push-pin.png">
                                </a>
                                <a href="#" class="icon-btn">
                                    <img src="img/vertical-dots.png">
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>
    </body>
</html>