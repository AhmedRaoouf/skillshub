<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index ()
    {
        $data['messages'] = Message::orderBy('id','Desc')->paginate(10);
        return view('admin.messages.index',$data);
    }
    public function show (Message $msg)
    {
        $data['message'] = $msg;
        return view('admin.messages.show',$data);
    }

    public function response (Message $msg , Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Mail::to($msg->email)->send(new ContactMail($msg->name,$request->title , $request->body));
        return redirect('dashboard/messages');
    }
}
