<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        //$posts = Post::orderBy('created_at', 'desc')->paginate(5);

        return view('pages.index');
        //return view('pages.index');
    }

    public function politicas(){
        return view('pages.politicas');
    }

    public function sobre(){
        return view('pages.sobre');
    }

}
