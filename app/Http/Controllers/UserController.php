<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registracijaKorisnika(Request $request){

        $data = $request -> validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'repeat_password' => 'required|same:password'

        ],
        [
            'name.required' => 'Ime je obavezno',
            'surname.required' => 'Prezime je obavezno',
            'email.required' => 'Email je obavezan',
            'email.email' => 'Email nije u ispravnom formatu',
            'password.required' => 'Lozinka je obavezna',
            'repeat_password.required' => 'Ponovljena lozinka je obavezna',
            'repeat_password.same' => 'Lozinke se ne podudaraju',

        ]
        );

        $existMail = User::where('email', $data['email'])->first(); 

        if($existMail){
            return response()->json(['existMail' => 'Postoji korisnik s tim emailom'],404);
        }

        $data['password'] = Hash::make($data['password']);
        $data['repeat_password'] = Hash::make($data['repeat_password']);
        $data['role'] = 'korisnik'; //default role
        $user = new User();
        $user->create($data);
        return response()->json(['message' => 'Uspjesno ste se registrirali!'], 201);
    }

    public function prijavaKorisnika(Request $request){
        $data = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',

            ],
            [

                'email.required' => 'Niste unijeli vas email',
                'password.required' => 'Niste unijeli vasu lozinku'
            ]
        );


        if (Auth::attempt($data)) {
            $user = Auth::user();
            return response()->json(['message' => 'Uspjesna prijava', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Neuspjesna prijava']);
        }
    }

    public function odjavaKorisnika(){
        Auth::logout();
        return response()->json(['redirect' => '/login']);
    }

    public function dohvatiKorisnika(){
        $user = Auth::user();
        return response()->json($user);
    }

    public function dohvatiKorisnike(){
        $users = User::get();
        return response()->json(['users' => $users]);
    }


    public function izbrisiKorisnika($id){
        $user = User::findorFail($id);
        $user->delete();
        return response()->json(['message' => 'Korisnik izbrisan']);
    }

    public function promovirajKorisnika($id){
        $user = User::findorFail($id);
        $user->role = 'admin';
        $user->save();
        return response()->json(['message' => 'Korisnik promoviran']);
    }

    public function isUserLogged()
    {

        $user = Auth::user();
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'Niste prijavljeni!']);
        }
    }
}
