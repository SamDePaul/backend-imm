<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class FrontendRegisterController extends Controller
{
    /**
     * Register a new users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'negara' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => $request->password,
            'no_hp' => $request->no_hp,
            'negara' => $request->negara,
            'provinsi' => $request->provinsi,
            'alamat' => $request->alamat,
            'role' => 'users', // Set the users role to 'users'
        ]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'));
    }
}
