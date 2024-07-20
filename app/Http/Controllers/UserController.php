<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Mail\MailableVerification;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function login() 
    {   
        return view("Auth/login");
    }
    
    public function register() 
    {
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

        event(new Registered($user));
        Auth::login($user);
        // Mail::to($user['email'])->send(new MailableVerification($user['name']));
        
        toast('Akun anda berhasil didaftarkan. <br> Silahkan cek email untuk konfirmasi','success');
        // dd($res);
        return redirect('/');
    }


    public function auth()
    {
        $user = request()->validate([
            'email' => ['required','email:dns'],
            'password' => ['required','min:3'],
        ]); 

        if(Auth::attempt($user)){
            
            // if(!Auth::user()->email_verified_at){
            //     Auth::logout();
            //     toast("Maaf, Akun belum terverifikasi!",'error');
            //     return redirect('/login');
            // }
            
            request()->session()->regenerate();
            
            // if account is normal user or admin
            if(!Auth::user()->isAdmin){
                return redirect('/');
            } else{
                return redirect('/admin');
            }
        } 
        
        // if failed
        toast("<b>Maaf, data pengguna tidak ditemukan</b> <br> cek kembali data yang dimasukan!",'error');
        return back();
    }

    public function edit(User $user)
    {
        if(Gate::denies('edit_user', $user)){
            return redirect()->back();
        }

        return view("auth/edit", ['user' => $user]);
    }

    public function personal_data_edit()
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'address' => ['required','min:3'],
            'phone_number' => ['required','min:10'],
        ]);
        
        $user = User::where('id', Auth()->user()->id)->update([
            'name' => request('name'),
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
