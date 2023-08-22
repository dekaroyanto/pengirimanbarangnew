<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Pesanan;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $user   = User::all();
        $infopesanan = Pesanan::latest()->paginate(1);
        $infopelanggan = Pelanggan::latest()->paginate(1);
        return view('register', compact('infopesanan', 'infopelanggan'))->with('user', $user);
    }

    public function login()
    {
        return view('login');
    }

    public function loginproses(Request $request)
    {
        // if (Auth::attempt($request->only('username', 'password'))) {
        //     return redirect('/');
        // }
        // return redirect('login');


        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'loginError' => 'Username atau password salah'
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function registeruser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
        ], [
            'name.required' => 'Masukan nama',
            'email.required' => 'Masukan email',
            'username.required' => 'Masukan username',
            'username.unique' => 'Username tidak boleh sama',
            'password.required' => 'Masukan password'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
            'role' => $request->role1,
        ]);
        return redirect('register')->with('success', 'Data Berhasil Di Tambahkan');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function tampilkanuser($id)
    {
        $user = User::find($id);
        // dd($data);

        return view('register', compact('user'));
    }

    public function updateuser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Masukan nama',
            'email.required' => 'Masukan email',
            'username.required' => 'Masukan username',
            'passowrd.required' => 'Masukan password'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect('register')->with('success', 'Data Berhasil Di Ubah');
    }

    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('register')->with('success', 'Data Berhasil Di Hapus');
    }
}
