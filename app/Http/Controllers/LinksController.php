<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function index()
    {
        $links = Link::where('user_id',Session('user_id'))->paginate(15);

        return view('links',compact('links'));
    }
}
