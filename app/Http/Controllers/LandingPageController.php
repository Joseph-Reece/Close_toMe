<?php

namespace App\Http\Controllers;
use App\post;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        $post = post::Paginate(5);
        return view('welcome')->with('posts', $post);
    }
}
