<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LondriController extends Controller
{
    public function index(){
        return view('loundri.index');
    }
}
