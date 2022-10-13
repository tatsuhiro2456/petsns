<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Reply;

class RecruitmentController extends Controller
{
    public function view(Recruitment $recruitment)
    {
        return view('home/walking')->with(['recruitments' => $recruitment->get()]);
    }
    
    public function recruitment()
    {
        return view('home/recruitment');
    }
    
    public function store(Request $request)
    {
        $recruitment = new Recruitment();
        $recruitment->user_id = auth()->id();
        $recruitment->title = $request->recruitment['title'];
        $recruitment->body = $request->recruitment['body'];
        $recruitment->save();
        
        return redirect('/walking');
    }
    
    public function reply(Recruitment $recruitment, $id)
    {
        $recruitment = Recruitment::find($id);
        return view('home/reply')->with(['recruitment' => $recruitment]);
    }
    
    public function destroy($id)
    {
        $recruitment = Recruitment::find($id);
        $reply = Reply::where('recruitment_id', $recruitment->id);
        $recruitment->delete();
        $reply->delete();
        return redirect('/walking');
    }
    
    public function reply_post(Request $request)
    {
        $reply = new Reply();
        $reply->user_id = auth()->id();
        $reply->body = $request->reply['body'];
        $reply->recruitment_id =$request->reply['recruitment_id'];
        $reply->save();
        
        return redirect('/walking');
    }
    
    public function reply_destroy($id)
    {
        $reply = Reply::find($id);
        $reply->delete();
        
        return redirect('/walking');
    }
}