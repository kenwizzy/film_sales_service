<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dob' => ['required', function ($attribute, $value, $fail) {
                $now = Carbon::now();
                $userDob = Carbon::parse($value);
                if ($userDob->diffInYears($now) <= 18) {
                    $fail('Sorry, your age must be 18 years and above');
                }
             },],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
        ]);

        Account::create(['user_id' => $user->id]);

        //event(new Registered($user));

        Auth::logout($user);

        return redirect('/login')->withSuccess('Successfully registered, Please login');

    }
}
