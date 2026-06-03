<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return back()->withErrors([
            'email' => 'Неверный email или пароль.',
        ]);
    }
    
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);
        
        // Убрал автоматический вход
        // Auth::login($user);
        
        return redirect()->route('login')->with('success', 'Регистрация прошла успешно! Теперь вы можете войти.');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
     // Личный кабинет
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    
    // Обновление профиля
    public function updateProfile(Request $request)
{
    $user = Auth::user();
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'password' => 'nullable|string|min:8|confirmed',
    ]);
    
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->phone = $validated['phone'] ?? null;
    
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }
    
    $user->save();
    
    return back()->with('success', 'Профиль успешно обновлен!');
}
}

