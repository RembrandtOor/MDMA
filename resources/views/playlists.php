<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDMA - Playlists</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/playlists.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>
<body>
    
    <div class="content">
        <div class="logo">MDMA</div>
        <h1>You have no &#160;<span class="text-secondary">playlists &#160;</span> yet!</h1>
        <a href="<?= route('login') ?>" class="btn btn-primary btn-xS">+ CREATE PLAYLIST</a>
    </div>

</body>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MDMA - Playlist</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/playlists.css">
    </head>
    <body>
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
                <?php for($i=0; $i < 5; $i++):?>
                <!-- <a href="<?= route('playlist'); ?>"> -->
                    <div class="playlist">
                        <img class="playlist-img" src="img/images.jpeg">
                        <div class="playlist-details">
                            <a class="playlist-name" href="<?= route('playlist'); ?>">Thunderstruck</a>
                            <div class="playlist-author">Group name</div>
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
                <!-- </a> -->
                <?php endfor ?>
            </div>
        </div>
        
        <div class="navbar">
            <a href="#" class="active"><i class="fas fa-home fa-2x"></i></a>
            <a href="#"><i class="fas fa-search fa-2x"></i></a>
            <a href="#"><i class="fas fa-cog fa-2x"></i></a>
        </div>

    </body>
</html>