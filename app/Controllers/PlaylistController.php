<?php
namespace App\Controllers;

use App\Models\Playlist;

class IndexController {    
    public function index() {
        return view('playlist', [
            'playlists' => Playlist::all()
        ]);
    }
}