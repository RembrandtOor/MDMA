<?php
namespace App\Controllers;

use App\Helpers\Request;
use App\Helpers\Auth;
use App\Models\Playlist;

class PlaylistController {    
    public function index() {
        return view('playlists', [
            'playlists' => Playlist::all()
        ]);
    }

    public function show(Request $request) {
        if(!isset($request->id)) return redirect(route('playlists'));
        $playlist = Playlist::find($request->id);
        if(!$playlist) return redirect(route('playlists'));
        return view('playlist', [
            'playlist' => $playlist,
            // 'songs' => PlaylistSongs::where('playlist_id', $id)->get()
        ]);
    }

    public function create(Request $request) {
        if(!Auth::check()) {
            return response()->json([
                'success' => false,
                'error' => 'You have to be logged in to do this'
            ]);
        }
        $count = Playlist::where('created_by', Auth::user()->getId())->count();
        $playlist = Playlist::create([
            'name' => 'Playlist '.($count+1),
            'icon_url' => 'img/images.jpeg',
            'created_by' => Auth::user()->getId(),
        ]);
        if($playlist) {
            return response()->json([
                'success' => true,
                'message' => 'Playlist successfully created',
                // 'playlist_id' => $playlist->getId(),
                'playlist_url' => $playlist->getUrl()
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Could not create a new playlist'
        ]);
    }

    public function update(Request $request) {

    }

    public function delete(Request $request) {

    }

    public function getList() {
        return Playlist::allJSON();
    }
}