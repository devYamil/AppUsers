<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DateTime;

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
        $alert = 'false';
        if($request->get('alert') == 'true'){
            $alert = 'true';
        }

        return view('users/list_users', ['users' => $users, 'search' => $search, 'alert' => $alert]);
    }

    public function editUser($id){
        $user = User::where('id', '=', $id)->first();

        $city = City::where('name_city', '=', $user->city)->first();
        $state = State::where('id', '=', $city->id_state)->first();
        $country = Country::where('id', '=', $state->id_country )->first();

        $message = array();
        $typeError = '';
        $showMessage = false;

        return view('users/edit_user', ['user' => $user, 'city' => $city, 'state' => $state, 'country' => $country, 'message' => $message, 'showMessage' => $showMessage, 'typeError' => $typeError]);
    }

    public function updateUser(Request $request){

        $id_user = $request->get('id_user');
        $name = $request->get('name');
        $phoneNumber = $request->get('phone_number');
        $dateBirth = $request->get('date_birth');
        $city = City::where('id', '=', $request->get('city'))->first();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100'],
            'phone_number' => ['max:10'],
            'date_birth' => ['required',
                // VALIDAR QUE SEA MAYOR A 18 ANIOS
                function ($attribute, $value, $fail) {
                    $date1 = new DateTime($value);
                    $date2 = new DateTime();
                    $diff = $date1->diff($date2);

                    $anios = (int)$diff->y;

                    if($anios < 18){
                        return $fail('Date birth You must be over 18 years old');
                    }
                }],
            'city' => ['required', 'string'],
        ]);

        $showMessage = true;


        if($validator->fails()){
            $message = $validator->messages()->all();
            $typeError = 'danger';
        }else{
            $message = array('message' => 'The user has been successfully update');
            $typeError = 'success';
            $arrayData = array('name' => $name, 'phone_number' => $phoneNumber, 'date_birth' => $dateBirth, 'city' => $city->name_city);
            User::where('id', $id_user)->update($arrayData);
        }

        $user = User::where('id', '=', $id_user)->first();

        $city = City::where('name_city', '=', $user->city)->first();
        $state = State::where('id', '=', $city->id_state)->first();
        $country = Country::where('id', '=', $state->id_country )->first();

        return view('users/edit_user', ['user' => $user, 'city' => $city, 'state' => $state, 'country' => $country, 'message' => $message, 'showMessage' => $showMessage, 'typeError' => $typeError]);
    }

    public function deleteUser($id){
        User::where('id',$id)->delete();

        $alert = 'true';

        return redirect('user-list?alert='.$alert);
    }
}
