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

    // uuid generator: \Uuid::uuid4();

    public function create(Request $request) {
        
    }
}