<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
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

    public function getUsers(Request $request){
        $users = User::all();
        $search ='';
        /*return view('users/list_users', ['users' => $users]);*/

        $countRegisterByPage = 5;

        if($request){
            $search = trim($request->get('search'));
            if($request->get('sortByName')){
                $users = User::where(function($query) use ($search){
                    $query->orWhere('name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('identity_card', 'LIKE', '%'.$search.'%');
                    $query->orWhere('email', 'LIKE', '%'.$search.'%');
                    $query->orWhere('phone_number', 'LIKE', '%'.$search.'%');
                })
                    ->orderBy('name', 'asc')
                    ->paginate($countRegisterByPage);
            }elseif($request->get('sortByEmail')){
                $users = User::where(function($query) use ($search){
                    $query->orWhere('name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('identity_card', 'LIKE', '%'.$search.'%');
                    $query->orWhere('email', 'LIKE', '%'.$search.'%');
                    $query->orWhere('phone_number', 'LIKE', '%'.$search.'%');
                })
                    ->orderBy('email', 'asc')
                    ->paginate($countRegisterByPage);
            }elseif($request->get('sortByPhoneNumber')){
                $users = User::where(function($query) use ($search){
                    $query->orWhere('name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('identity_card', 'LIKE', '%'.$search.'%');
                    $query->orWhere('email', 'LIKE', '%'.$search.'%');
                    $query->orWhere('phone_number', 'LIKE', '%'.$search.'%');
                })
                    ->orderBy('phone_number', 'asc')
                    ->paginate($countRegisterByPage);
            }else{
                $users = User::where(function($query) use ($search){
                    $query->orWhere('name', 'LIKE', '%'.$search.'%');
                    $query->orWhere('identity_card', 'LIKE', '%'.$search.'%');
                    $query->orWhere('email', 'LIKE', '%'.$search.'%');
                    $query->orWhere('phone_number', 'LIKE', '%'.$search.'%');
                })
                    ->orderBy('id', 'asc')
                    ->paginate($countRegisterByPage);
            }


        }

        return view('users/list_users', ['users' => $users, 'search' => $search]);
    }
}
