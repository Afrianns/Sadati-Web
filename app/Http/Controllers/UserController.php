<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    
    public function login() {
        return view("Auth/login");
    }

    public function register() {
        return view("Auth/register");
    }

    public function store(){

        request()->validate([
            'name' => ['required'],
            'email' => ['required','email:dns','unique:users'],
            'address' => ['required'],
            'phone_number' => ['required','min:10'],
            'password' => ['required','min:3','confirmed'],
        ]);
        
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'address' => request('address'),
            'phone_number' => request('phone_number'),
            'password' => request('password'),
        ]);

        Auth::login($user);

        toast('Akun anda berhasil didaftarkan.','success');
        return redirect('/');
    }


    public function auth()
    {
        $user = request()->validate([
            'email' => ['required','email:dns'],
            'password' => ['required','min:3']
        ]);  

        if(Auth::attempt($user)){
            request()->session()->regenerate();
            return redirect('/');
        }
        
        toast("Maaf, data pengguna tidak ditemukan",'error');
        return back();
    }

    public function edit(User $user)
    {
        return view("auth/edit", ['user' => $user]);
    }

    public function personal_data_edit()
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required','email:dns', Rule::unique('users')->ignore(Auth()->user()->id)],
            'address' => ['required','min:3'],
            'phone_number' => ['required','min:10'],
        ]);
        
        $user = User::where('id', Auth()->user()->id)->update([
            'name' => request('name'),
            'email' => request('email'),
            'address' => request('address'),
            'phone_number' => request('phone_number')
        ]);

        if($user){
            toast("Profil berhasil diperbarui","success");
            return redirect("/");
        } 
        toast("Profil gagal diperbarui","error");

    }

    public function password_edit()
    {
        request()->validate([
            'old_password' => ['required','min:3'],
            'password' => ['required','confirmed'],
        ]);


        if(Hash::check(request('old_password'), Auth()->user()->password)){
            User::where('id', Auth()->user()->id)->update(['password' => Hash::make(request()->password)]);

            toast('Password berhasil diperbarui','success');
            return redirect('/');
        }

        toast('password lama tidak sesuai','error');
        return redirect()->back();

        // dd(request()->all(), Auth()->user()->password);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');    
    }
}
