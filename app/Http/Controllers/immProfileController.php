<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Otp;

class ImmProfileController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function GetloginOtp(Request $request)
    {
        /* Generate OTP */
        $otp = $this->otp->generate($request->email, 'numeric', 6, 15);

        $data = [$request->email, $request->no_hp];
        /* Prepare email content */
        $emailData = [
            'email' => $request->email,
            'title' => 'Your Email Verification',
            'otp' => $otp->token,
        ];

        try {
            // Send email using Mail::send with a Mailable class (recommended)
            Mail::send('mailVerification', ['data' => $emailData], function ($message) use ($emailData) {
                $message->to($emailData['email'])->subject($emailData['title']);
            });
            return response([
                'email' => $emailData['email'],
                'success' => $otp->status,
                'message' => $otp->message,
                'token' => $otp->token,
                'email_sent' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response([
                'email' => $request->email,
                'success' => false,
                'message' => 'Failed to send OTP via email: ' . $e->getMessage(),
                'token' => null,
                'email_sent' => false,
            ]);
        }
    }

    public function VerifyOtp(Request $request)
    {
        $email = $request->email;
        $otpCode = $request->otp_code;

        // Validate email and OTP code (optional)
        // You can add validation rules here to ensure email is valid format and OTP code has a certain length, etc.

        $verified = $this->otp->validate($email, $otpCode);

        if ($verified) {
            // OTP is valid, process successful verification logic
            return response([
                'success' => true,
                'message' => 'OTP verification successful!',
                'email'=> $email,
                'otp'=> $otpCode,
            ]);
        } else {
            // OTP is invalid, handle failed verification
            return response([
                'success' => false,
                'message' => 'Invalid OTP code. Please try again.',
            ]);
        }
    }

}
