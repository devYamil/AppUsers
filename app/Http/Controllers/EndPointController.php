<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class EndPointController extends Controller
{
    public function __construct()
    {
        // NO NECESITO MIDDLEWARE $this->middleware('auth');
    }

    /*
     *
     * PARAMETROS OPCIONALES
     * SEARCH
     * ORDER BY CREATE AT
     *
     */
    public function getEmails(Request $request){
        $countRegisterByPage = 5;
        $search ='';
        $createdAt = 'asc';
        if($request->get('order_by_created_at')){
            $createdAt = $request->get('order_by_created_at');
        }

        $emails = array();

        if($request->get('search')){
            $search = $request->get('search');
            $emails = Email::where(function($query) use ($search){
                $query->orWhere('subject', 'LIKE', '%'.$search.'%');
                $query->orWhere('destination', 'LIKE', '%'.$search.'%');
                $query->orWhere('message', 'LIKE', '%'.$search.'%');
                })
                ->orderBy('created_at', $createdAt)
                ->paginate($countRegisterByPage);
        }elseif($request->get('order_by_created_at')){
            $emails = Email::all()
                ->orderBy('created_at', $createdAt)
                ->paginate($countRegisterByPage);
        }

        $arrayData = [
            'emails' => $emails,
            'search' => $search,
            'order_by_created_at' => $createdAt,
            'message' => 'Get end point emails',
        ];

        return response()->json($arrayData, 200);
    }

    public function getDataUser(Request $request){
        $user = array();
        if($request->get('id_user')){
            $id_user = $request->get('id_user');
            $user = User::where('id', '=', $id_user)->first();
            $date1 = new DateTime($user['date_birth']);
            $date2 = new DateTime();
            $diff = $date1->diff($date2);

            $anios = (int)$diff->y;
            $user['age'] = $anios;
        }
        $arrayData = [
            'user' => $user,
            'message' => 'Get user data',
        ];

        return response()->json($arrayData, 200);
    }
}
