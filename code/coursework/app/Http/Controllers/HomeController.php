<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cats;

class HomeController extends Controller
{
    public function homeView(Cats $c){
        $catUrl = $c->getCat();

        return view('forum.home', ['catUrl' => $catUrl]);
    }
}
