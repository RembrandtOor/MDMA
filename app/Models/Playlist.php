<?php
namespace App\Models;

class Playlist extends Model {
    public function getId() {
        return $this->id;
    }
    
    public function getIconUrl() {
        return asset('data/playlists/'.$this->uuid.'.png');
    }

    public function getName() {
        return $this->name;
    }

    public function getCreator() {
        // return $this->created_by;
        return 'daniel';
    }

    public function getUrl() {
        return route('playlist', ['id' => $this->getId()]);
    }

    public function songs() {
        return $this->manyTroughMany(Song::class, PlaylistSong::class);
    }
}