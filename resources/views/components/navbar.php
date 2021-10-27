<div class="navbar">
    <a href="<?= route('playlists'); ?>" class="active"><i class="fas fa-home"></i></a>
    <a href="<?= route('search'); ?>"><i class="fas fa-search"></i></a>
    <a href="<?= route('logout'); ?>"><i class="fas fa-cog"></i></a>
    <a href="<?= route('panel'); ?>"><i class="fas fa-upload"></i></a>
</div>

<link rel="stylesheet" href="/css/navbar.css">
<div class="" id="music-player" style="display: none">
    <div class="song-data">
    <img id="song-icon" src="/img/images.jpeg">
        <div id="song-info">
            <div id="song-title">Loading..</div>
            <div id="song-album">Loading..</div>
        </div>
    </div>
    <div id="player-btns">
        <button id="play-pause" class="btn btn-circle btn-transparent btn-icon">
            <img src="/img/icons/play.png" />
        </button>
        <button id="open-player" class="btn btn-circle btn-transparent btn-icon">
            <img src="/img/icons/arrow_down.png" />
        </button>
    </div>
</div>

<audio id="audio-element" preload="auto">

</audio>