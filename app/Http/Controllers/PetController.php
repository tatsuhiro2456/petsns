<?php

namespace App\Http\Controllers;

use App\Pet;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function add()
    {
        return view('home/pet_register');
    }
    
    public function register(Request $request,Pet $pet)
    {
        $input = $request['pet'];
        $input += ['user_id' => $request->user()->id]; 
        $pet->fill($input)->save();
        
        return redirect('/');
    }
    
}
