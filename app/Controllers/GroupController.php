<?php
namespace App\Controllers;

use App\Helpers\Request;
use App\Models\Group;

class groupController {    
    public function index() {
        return view('groups', [
            'groups' => Group::all()
        ]);
    }

    public function show(Request $request) {
        if(!isset($request->id)) {
            return redirect(route('groups'));
        }
        return view('group', [
            'group' => Group::find($request->id),
        ]);
    }

    public function getList() {
        return Group::allJSON();
    }
}