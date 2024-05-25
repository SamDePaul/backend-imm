<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('role', 'users') // Filter by user role first
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('nama_lengkap', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = new User(); // Create a new User instance
        $countries = Country::all();
        return view('users.create', compact('user', 'countries'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|min:16|max:16',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|min:10|max:13',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $User = new User;

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'email' => $request->email,
            'password' => $request->password,
            'no_hp' => $request->no_hp,
            'negara' => $request->negara,
            'provinsi' => $request->provinsi,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $countries = Country::all();
        return view('users.edit', compact('user', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|min:16|max:16',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|min:10|max:13',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->negara = $request->negara;
        $user->provinsi = $request->provinsi;
        $user->alamat = $request->alamat;

         // Check if a new password has been provided
        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
