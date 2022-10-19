<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{
    public function index(Content $content)
    {
        return view('contents.index')->with(['posts' => $content->getByContent()]);
    }
}
