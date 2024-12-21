<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StaffRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthControoler extends Controller
{
    public function create()
    {
        return view('Dashboard.Staffs.Auth.signin');
    }


    public function store(StaffRequest $request)
    {
        if($request->authenticate()){
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::STAFF);
        }else{
            return back()->withErrors(['error','NO Auth']);
        }


    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyStaff(Request $request)
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/'));    }
}
