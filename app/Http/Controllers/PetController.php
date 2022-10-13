<?php

namespace App\Http\Controllers;

use App\Pet;
use App\User;
use App\Http\Requests\PetRequest;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function add()
    {
        return view('home/pet_register');
    }
    
    public function register(Pet $pet, PetRequest $request)
    {
        $input = $request['pet'];
        $input += ['user_id' => $request->user()->id]; 
        $pet->fill($input)->save();
        
        return redirect('/');
    }
}
