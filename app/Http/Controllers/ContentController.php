<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(Content $content)
    {
        return view('contents.index')->with(['posts' => $content->getByContent()]);
    }
}
