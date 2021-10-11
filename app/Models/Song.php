<?php
namespace App\Models;

use App\Models\Model;

class Song extends Model {
    public function getName() {
        return $this->name;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function getIconUrl() {
        return asset('data/song_icons/'.$this->icon.'.png');
    }
}