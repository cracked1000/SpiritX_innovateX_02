<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }
    public function saveTeam(Request $request)
    {
    $user = Auth::user();
    $validated = $request->validate([
        'batsman_1' => 'required|exists:players,id',
        'bowler_1' => 'required|exists:players,id',
        // ... other validations ...
        'all_rounder_4' => 'required|exists:players,id',
    ]);

    $selectedPlayerIds = [
        $request->input('batsman_1'),
        $request->input('bowler_1'),
        // ... other IDs ...
        $request->input('all_rounder_4'),
    ];

    if (count(array_unique($selectedPlayerIds)) !== 11) {
        return redirect()->back()->withErrors(['team' => 'Cannot select the same player twice.']);
    }

    $selectedPlayers = Player::findMany($selectedPlayerIds);
    $totalValue = $selectedPlayers->sum('value');

    if ($totalValue > $user->budget) {
        return redirect()->back()->withErrors(['team' => 'Total player value exceeds your current budget!']);
    }

    $user->players()->sync($selectedPlayerIds);
    $user->budget -= $totalValue;
    $user->save();

    return redirect()->route('user.dashboard')->with('success', 'Team saved successfully!');
   }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);
    }

    /**
     * Show the signup form.
     */
    public function showSignup()
    {
        return view('auth.signup');
    }

    /**
     * Handle the signup request.
     */
    public function signup(Request $request)
    {
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[0-9]/',
    ]);

    User::create([
        'username' => $request->username,
        'password' => Hash::make($request->password),
        'budget' => 9000000,
    ]);

    return redirect('/login')->with('success', 'Signup successful! Please log in.');
    }

    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}