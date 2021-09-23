<?php
namespace App\Controllers;

use App\Models\Playlist;

class PlaylistController {    
    public function index() {
        return view('playlists', [
            'playlists' => Playlist::all()
        ]);
    }

    public function show($request) {
        return view('playlist', [
            'playlist' => Playlist::find($request->id),
            // 'songs' => PlaylistSongs::where('playlist_id', $id)->get()
        ]);
    }

    public function getList() {
        return Playlist::allJSON();
    }
}