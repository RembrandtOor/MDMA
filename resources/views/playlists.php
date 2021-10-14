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
                <button id="create-playlist" class="btn btn-primary btn-xS">+ CREATE PLAYLIST</button>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="search-bar">
                    <input type="text class="search-input" placeholder="Search">
                    <button id="create-playlist" class="btn btn-circle btn-transparent add-playlist-btn">
                        <img src="img/plus-2.png">
                    </button>
                </div>

                <h1 class="text-center">Playlists</h1>
                <div class="splitter"></div>

                <div class="playlist-list">
                    <?php foreach($playlists as $playlist):?>
                        <div class="playlist">
                            <a href="<?= $playlist->getUrl(); ?>">
                                <img class="playlist-img" src="<?= $playlist->getIconUrl() ?>">
                            </a>
                            <a href="<?= $playlist->getUrl(); ?>" class="playlist-details">
                                <div class="playlist-name"><?= $playlist->getName() ?></div>
                                <!-- <div class="playlist-author">Group name</div> -->
                            </a>
                            <div class="playlist-buttons">
                                <!-- <a href="#" class="icon-btn">
                                    <img src="img/push-pin.png">
                                </a>
                                <a href="#" class="icon-btn">
                                    <img src="img/vertical-dots.png">
                                </a> -->
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/app.js"></script>
    </body>
</html>