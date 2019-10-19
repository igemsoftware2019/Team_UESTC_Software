<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\User_comment;

class CommentController extends Controller
{
    public function write(Request $request){
        // $data = Auth::user();

        // $data = $request->session()->get('_previous.url');
        if (Auth::check()) {
        $name = Auth::user()->name;
        $comment = $request->input('comment');
        $igemid = $request->input('igemid');
        // dd($comment);
        User_comment::create([
            'name'=>$name,
            'comment'=>$comment,
            'igemid'=>$igemid,
        ]);
        $url = $request->session()->get('_previous.url');
        return redirect($url);
        }
        else{
            return redirect()->route('login');
        }

    }
}
