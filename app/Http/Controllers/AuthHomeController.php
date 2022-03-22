<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
// use Spatie\Newsletter\Newsletter;
use Newsletter;

class AuthHomeController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'subscriber_email' => 'required|email'
        ]);

        try {
            if (Newsletter::isSubscribed($request->subscriber_email)) {
                return redirect()->back()->with('error', 'Email is already subscribed');
            } else {
                Newsletter::subscribe($request->subscriber_email);

                return redirect()->back()->with('success', 'Email subscribed');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}