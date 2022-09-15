<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\PemesanModel;
use Session;

class AuthController extends Controller
{
    //
    public function registrasi(Request $req)
    {
        if ($req->method() == 'POST') {
            $data = $req->except(['_method', '_token']);
            $data['password'] = bcrypt($req->password);

            $cek_model = User::where('email', $req->email)->first();
            if (!empty($cek_model)) {
                return redirect()->back()->with('message_info', 'Email anda telah terdaftar');
            } else {
                $model = new User($data);
                if ($model->save()) {
                    $req_pemesan =  $req->except(['_method', '_token', 'email', 'name', 'password']);
                    $req_pemesan['id_user'] = $model->id;
                    $model_pemesan = new PemesanModel($req_pemesan);
                    $model_pemesan->save();
                    return redirect('login')->with('message_success', 'Selamat email anda telah terdaftar');
                }
                return redirect('registrasi')->with('message_fail', 'Maaf, email anda gagal untuk terdaftar');
            }
        } else {
            return view('Auth.registrasi');
        }
    }


    public function login(Request $req)
    {
        if ($req->method() == 'POST') {

            $model = User::where('email', $req->email)->first();

            if (empty($model)) {
                return redirect('login')->with('message_fail', 'Email anda belum terdaftar');
            }

            if (Hash::check($req->password, $model->password)) {
                if ($model->level == 'admin') {
                    Session::put('id', $model->id);
                    Session::put('level', $model->level);
                    return redirect('dashboard')->with('message_success', 'Selamat datang');
                }else if ($model->level == 'staf') {
                    Session::put('id', $model->id);
                    Session::put('level', $model->level);
                    return redirect('dashboard')->with('message_success', 'Selamat datang');
                }
                else if ($model->level == 'pemesan') {
                    Session::put('id', $model->id);
                    return redirect('booking')->with('message_success', 'Selamat datang');
                }
            } else {
                return redirect('/')->with('message_fail', 'Username atau password anda salah');
            }
        } else {
            return view('Auth.login');
        }
    }
}
