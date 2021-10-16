<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        // Validasi masukan Form Login
        $validatedData = $request->validate([
            'name' => 'required|min:12|max:50',
            'username' => 'required|min:6|max:24|unique:users',
            'email' => 'required|unique:users|email:dns',
            'password' => ['required', 'min:6', 'max:24']

        ]);

        // Hashing password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Buat user berdasarkan  data yang sudah divalidasi $validatedData
        User::create($validatedData);


        // Redirect halaman
        // $request->session()->flash('registersuccess', 'Register has been Succesfully! Please Login');
        return redirect('/login')->with('registersuccess', 'Register has been Succesfully! Please Login');
    }
}
