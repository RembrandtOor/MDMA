<?php
namespace App\Models;

use App\Models\Model;

class Song extends Model {
    public function getName() {
        return $this->name;
    }

    public function artist() {
        return $this->belongsTo(Artist::class);
    }

    public function getIconUrl() {
        return asset('data/song_icons/'.$this->uuid.'.png');
    }

    public function getAudioUrl() {
        return asset('data/songs/'.$this->uuid.'.mp3');
    }

    public function getSongData() {
        return [
            'name' => $this->name,
            'icon_url' => $this->getIconUrl(),
            'artist' => $this->artist()->getName(),
            'src' => $this->getAudioUrl()
        ];
    }
}