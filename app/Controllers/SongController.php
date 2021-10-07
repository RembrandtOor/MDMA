<?php
namespace App\Controllers;

use App\Helpers\Request;
use App\Models\Song;

class SongController {    
    public function index() {
        return view('songs', [
            'songs' => Song::all()
        ]);
    }

    public function create(Request $request) {
        
    }
}