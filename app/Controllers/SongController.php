<?php
namespace App\Controllers;

use App\Models\Song;

class SongController extends Controller{    
    public function index() {
        return view('songs', [
            'songs' => Song::all()
        ]);
    }
}