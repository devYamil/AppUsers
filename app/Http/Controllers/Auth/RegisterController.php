<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use DateTime;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) {
                    // VALIDAR QUE EL PASSWORD TENGA AL MENOS UN NUMERO
                    $buscarNumeros = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    if($buscarNumeros == 0){
                        $fail('Password, You must enter at least one number');
                    }
                    // VALIDAR QUE EL PASSWORD TENGA AL MENOS UNA MAYUSCULA
                    $cantidadMayusculas = strlen(preg_replace('![^A-Z]+!', '', $value));
                    if($cantidadMayusculas == 0){
                        $fail('Password, You must enter at least one capital letter');
                    }

                    // OTRA FORMA DE VALIDAR TODO EN UNO CON EXPRESIONES RGULARES $pattern = "/ ^ (? =.[a-z]) (? =.[A-Z]) (? =.d) (? =.[^ A-Za-zd]) [sS] {6,16} $ / ";
                    $validarCaracteresEspeciales = preg_match('/[^a-zA-Z\d]/', $value);

                    if($validarCaracteresEspeciales == 0){
                        $fail('Password, You must enter at least one special character');
                    }

                }],
            'name' => ['required', 'string', 'max:100'],
            'phone_number' => ['max:10'],
            'identity_card' => ['required', 'string', 'max:11'],
            'date_birth' => ['required',
                // VALIDAR QUE SEA MAYOR A 18 ANIOS
                function ($attribute, $value, $fail) {
                    $date1 = new DateTime($value);
                    $date2 = new DateTime();
                    $diff = $date1->diff($date2);

                    $anios = (int)$diff->y;

                    if($anios < 18){
                        $fail('Date birth, You must be over 18 years old');
                    }
                }],
            'city' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $city = City::where('id', '=', $data['city'])->first();
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'identity_card' => $data['identity_card'],
            'date_birth' => $data['date_birth'],
            'city' => $city->name_city,
        ]);
    }
}
