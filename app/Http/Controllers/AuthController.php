<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Mail\EmailVerificationMail;
use App\Mail\ForgetPasswordMail;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('auth.register');
    }

    public function check_email_unique(Request $request)
    {
        $user = User::query()->where('email', $request->email)->first();
        if ($user) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:password',
            'terms' => 'required',
            // 'grecaptcha' => 'required'
        ], [
            'first_name.required' => 'First name is needed',
            'last_name.required' => 'Last name is also needed',
        ]);

        $grecaptcha = $request->grecaptcha;
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                    'response' => $grecaptcha
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        if ($body->success == true) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'email_verification_code' => Str::random(40)
            ]);

            Mail::to($request->email)->send(new EmailVerificationMail($user));

            return redirect()->back()->with('success', 'Registration successful. Please check your email adress for verification link');
        } else {
            return redirect()->back()->with('error', 'Invalid recaptcha');
        }
    }

    public function verify_email($verification_code)
    {
        $user = User::where('email_verification_code', $verification_code)->first();
        if (!$user) {
            return redirect()->route('getRegister')->with('error', 'Invalid URL');
        } else {
            if ($user->email_verified_at) {
                return redirect()->route('getRegister')->with('success', 'Email already verified');
            } else {
                $user->update([
                    'email_verified_at' => \Carbon\Carbon::now()
                ]);

                return redirect()->route('getRegister')->with('success', 'Email successfully verified');
            }
        }
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:100',
            // 'grecaptcha' => 'required'
        ]);

        $grecaptcha = $request->grecaptcha;
        $client = new Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => env('GOOGLE_CAPTCHA_SECRET'),
                    'response' => $grecaptcha
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        if ($body->success == true) {

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'Email is not registered');
            } else {
                if (!$user->email_verified_at) {
                    return redirect()->back()->with('error', 'Email is not verified');
                } else {
                    if (!$user->is_active) {
                        return redirect()->back()->with('error', 'User is not active. Please contact admin');
                    } else {
                        $remember_me = ($request->remember_me) ? true : false;
                        if (auth()->attempt($request->only('email', 'password'), $remember_me)) {

                            return redirect()->route('dashboard')->with('success', 'Login successful');
                        } else {
                            return redirect()->back()->with('error', 'Invalid credentials');
                        }
                    }
                }
            }
        } else {
            // return redirect()->back()->with('error', 'Invalid recaptcha');
        }
    }

    public function ajaxLogin(Request $request)
    {
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('getLogin')->with('success', 'Logout successful');
    }

    public function getForgetPassword()
    {
        return view('auth.forget_password');
    }

    public function postForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        } else {
            $reset_code = Str::random(200);
            PasswordReset::create([
                'user_id' => $user->id,
                'reset_code' => $reset_code
            ]);

            Mail::to($user->email)->send(new ForgetPasswordMail($user->first_name, $reset_code));

            return redirect()->back()->with('success', 'We have sent you a password reset link. Please check your email');
        }
    }

    public function getResetPassword($reset_code)
    {
        $password_reset_data = PasswordReset::where('reset_code', $reset_code)->first();

        if (!$password_reset_data || Carbon::now()->subMinutes(10) > $password_reset_data->created_at) {
            return redirect()->route('getForgetPassword')->with('error', 'Invalid password reset link or link expired');
        } else {
            return view('auth.reset_password', compact('reset_code'));
        }
    }

    public function postResetPassword($reset_code, Request $request)
    {
        $password_reset_data = PasswordReset::where('reset_code', $reset_code)->first();

        if (!$password_reset_data || Carbon::now()->subMinutes(10) > $password_reset_data->created_at) {
            return redirect()->route('getForgetPassword')->with('error', 'Invalid password reset link or link expired');
        } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6|max:100',
                'confirm_password' => 'required|same:password'
            ]);

            $user = User::find($password_reset_data->user_id);

            if ($user->email != $request->email) {
                return redirect()->back()->with('error', 'enter correct email address');
            } else {
                $password_reset_data->delete();
                $user->update([
                    'password' => bcrypt($request->password)
                ]);

                return redirect()->route('getLogin')->with('success', 'Password successfully reset');
            }
        }
    }
}