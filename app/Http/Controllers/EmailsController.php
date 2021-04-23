<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $date2 = new DateTime();
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

    public function envioMasivoEmails(){
        $emails = Email::where('status_send_email', '=', '0');


        foreach($emails as $email){
            $subject = $email->subject;
            $destination = $email->destination;
            $messageBody = $email->message;
            $data = array('name'=>"Yamil App Test");
            // ENVIAMOS CORREO
            Mail::send(['text'=>$messageBody], $data, function($message, $subject, $destination) {
                $message->to('appUsersRemitent@gmail.com', 'App Users')->subject($subject);
                $message->from($destination,'App Users');
            });
            // ACTUALIZAMOS ESTADO ENVIO
            $arrayData = array('status_send_email' => '1');
            User::where('id', $email->id)->update($arrayData);
        }


    }
}
