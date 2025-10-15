<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
	public function showLogin()
	{
		return view('auth.login');
	}

	public function showRegister()
	{
		return view('auth.register');
	}

	public function register(Request $request)
	{
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
			'role' => ['required', 'in:admin,user'],
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role' => $request->role,
		]);

		Auth::login($user);

		// Redirect based on role
		if ($user->isAdmin()) {
			return redirect()->route('admin.services.index');
		} else {
			return redirect()->route('home');
		}
	}

	public function login(Request $request)
	{
		$credentials = $request->validate([
			'email' => ['required', 'email'],
			'password' => ['required', 'string'],
		]);

		if (Auth::attempt($credentials, $request->boolean('remember'))) {
			$request->session()->regenerate();
			
			// Redirect based on user role
			if (Auth::user()->isAdmin()) {
				return redirect()->intended(route('admin.services.index'));
			} else {
				return redirect()->intended(route('home'));
			}
		}

		return back()->withErrors([
			'email' => 'Kredensial tidak valid.',
		])->onlyInput('email');
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login');
	}
}
