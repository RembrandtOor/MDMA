<?php
namespace App\Controllers;

use App\Helpers\Request;


class FormController extends Controller {    
    public function index() {
        return view('formtest');
    }

    public function post(Request $request) {
        echo 'SEARCH: '.$request->search;
    }
}