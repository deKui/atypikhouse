<?php

namespace App\Http\Controllers\Auth;

use DateTime;
use DateInterval;
use App\Models\User;
use App\Models\TypeHabitats;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
        // date aujourd'hui
        $date = new DateTime();
        // date - 18 ans
        $date_18 = $date->sub(new DateInterval('P18Y'));

        $rules = [
            'pseudo' => 'required|string|max:255|unique:users',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'date_naissance' => 'required|date_format:Y-m-d|before:' . $date_18->format('Y-m-d'),
        ];

        $messages = [
            'date_naissance.before' => 'Vous devez avoir 18 ans pour vous inscrire !',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);

        return User::create([
            'pseudo' => $data['pseudo'],
            'prenom' => $data['prenom'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'date_naissance' => $data['date_naissance'],
        ]);
    }

    public function showRegistrationForm()
    {
        $typeHabitat = TypeHabitats::all();

        $date = new DateTime(date_create('now')->format('Y-m-d'));

        $date->sub(new DateInterval('P18Y'));

        $date = $date->format('Y-m-d');

        return view('auth.register', compact('typeHabitat', 'date'));
    }
}
