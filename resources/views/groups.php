</body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Group</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/playlists.css">
        <link href="https://kit-pro.fontawesome.com/releases/latest/css/pro.min.css" rel="stylesheet">
    </head>
    <body>
        <?php view('components.navbar'); ?>

        <?php if(count($groups) == 0): ?>
            <div class="content">
                <div class="logo">MDMA</div>
                <h1>There are no &#160;<span class="text-secondary">groups &#160;</span> yet!</h1>
                <a href="<?= route('login') ?>" class="btn btn-primary btn-xS">+ CREATE GROUP</a>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="search-bar">
                    <input type="text class="search-input" placeholder="Search">
                    <a class="add-playlist-btn" href="#">
                        <img src="img/plus-2.png">
                    </a>
                </div>

                <h1 class="text-center">Groups</h1>
                <div class="splitter"></div>

                <div class="playlist-list">
                    <?php foreach($groups as $group):?>
                        <div class="playlist">
                            <img class="playlist-img" src="<?= $group->getIconUrl() ?>">
                            <div class="playlist-details">
                                <a class="playlist-name" href="<?= route('group', ['id' => $group->getId()]); ?>"><?= $group->getName() ?></a>                            </div>
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