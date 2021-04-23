<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createEmail(Request $request){
        $alert = 'false';
        if($request->get('alert') == 'true'){
            $alert = 'true';
        }
        return view('emails/create_email', ['alert'=>$alert]);
    }

    public function registerEmails(Request $request){
        Email::create([
            'id_user' => Auth::user()->id,
            'subject' => $request->get('subject'),
            'destination' => $request->get('destination'),
            'message' => $request->get('message'),
            'status_send_email' => '0',
        ]);

        $alert = 'true';

        return redirect('create-email?alert='.$alert);
    }

    public function listEmails(){
        $emails = Email::all();

        return view('emails/list_emails', ['emails' => $emails]);
    }
}
