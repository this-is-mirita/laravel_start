<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPlaceController extends Controller
{
    public function index($id, $module){
        return 'this is my_page ' . $id . '' . $module;
    }

}
