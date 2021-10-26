<?php
namespace App\Models;

use App\Models\User;

class Group extends Model {
    public function getId() {
        return $this->id;
    }
    
    public function getIconUrl() {
        return asset('data/song_icons/'.$this->uuid.'.png');
    }

    public function getName() {
        return $this->name;
    }

    public function getCreator() {
        // return $this->created_by;
        return 'Momen';
    }
}