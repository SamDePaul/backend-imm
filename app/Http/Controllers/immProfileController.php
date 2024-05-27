<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\immProfile;
use App\Models\EmailVerification;
use Mail;

class immProfileController extends Controller
{

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'no_hp' => 'required|string|max:15',
        ]);

        $otp = rand(100000,999999);
        $time = time();

        $user = new immProfile;
        $user->email = $request->email;

        EmailVerification::updateOrCreate(
            ['email' => $user->email],
            [
            'email' => $user->email,
            'otp' => $otp,
            'created_at' => $time
            ]
        );

        $data['email'] = $user->email;
        $data['title'] = 'Mail Verification';

        $data['body'] = 'Your OTP is:- '.$otp;

        Mail::send('mailVerification',['data'=>$data],function($message) use ($data){
            $message->to($data['email'])->subject($data['title']);
        });

        return redirect()->route('verifikasi-kode.form')
            ->with('email', $request->email)
            ->with('success', 'Verification code sent to your email.');
    }

    public function showCodeVerificationForm(Request $request)
    {
        return view('immprofiles.verifikasi_kode')->with('email', session('email'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|array',
            'code.*' => 'required|numeric|digits:1',
        ]);

        $input_code = implode('', $request->code);

        $immProfile = immProfile::where('email', $request->email)
            ->where('verification_code', $input_code)
            ->first();

        if ($immProfile) {
            return redirect()->route('immprofiles.index')
                ->with('success', 'Verifikasi berhasil.');
        } else {
            return back()->withErrors(['code' => 'Kode verifikasi salah.'])
                         ->withInput();
        }
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $immProfiles = ImmProfile::all();
    //     return view('immProfiles.index', compact('immProfiles'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('immProfiles.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_perusahaan' => 'required|string|max:255',
    //         'profil_perusahaan' => 'required|string',
    //         'email' => 'required|string|email|max:255|unique:immProfiles',
    //         'negara' => 'required|string|max:255',
    //         'provinsi' => 'required|string|max:255',
    //         'kota' => 'required|string|max:255',
    //         'no_hp' => 'required|string|max:15',
    //         'jml_karyawan' => 'required|integer',
    //         'tipe_perusahaan' => 'required|string|max:255',
    //     ]);

    //     ImmProfile::create($request->all());

    //     return redirect()->route('immProfiles.index')
    //         ->with('success', 'ImmProfile created successfully.');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\ImmProfile  $immProfile
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(ImmProfile $immProfile)
    // {
    //     return view('immProfiles.show', compact('immProfile'));
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\ImmProfile  $immProfile
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(ImmProfile $immProfile)
    // {
    //     return view('immProfiles.edit', compact('immProfile'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\ImmProfile  $immProfile
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, ImmProfile $immProfile)
    // {
    //     $request->validate([
    //         'nama_perusahaan' => 'required|string|max:255',
    //         'profil_perusahaan' => 'required|string',
    //         'email' => 'required|string|email|max:255|unique:immProfiles,email,' . $immProfile->id,
    //         'negara' => 'required|string|max:255',
    //         'provinsi' => 'required|string|max:255',
    //         'kota' => 'required|string|max:255',
    //         'no_hp' => 'required|string|max:15',
    //         'jml_karyawan' => 'required|integer',
    //         'tipe_perusahaan' => 'required|string|max:255',
    //     ]);

    //     $immProfile->update($request->all());

    //     return redirect()->route('immProfiles.index')
    //         ->with('success', 'ImmProfile updated successfully.');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\ImmProfile  $immProfile
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(ImmProfile $immProfile)
    // {
    //     $immProfile->delete();

    //     return redirect()->route('immProfiles.index')
    //         ->with('success', 'ImmProfile deleted successfully.');
    // }
}
