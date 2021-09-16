<?php
require_once __DIR__.'/../Helpers/Route.php';
require_once __DIR__.'/../Helpers/View.php';
require_once __DIR__.'/../Models/Song.php';

class SongController {    
    public function index() {
        return view('songs', [
            'songs' => Song::all()
        ]);
    }
}