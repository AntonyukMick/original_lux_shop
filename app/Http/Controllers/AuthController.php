<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Показать форму входа
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Обработать попытку входа
     */
    public function login(AuthRequest $request)
    {
        $validated = $request->validated();

        $authData = $this->authService->authenticate(
            $validated['telegram_tag'],
            $validated['password']
        );

        if (!$authData) {
            return back()->withErrors(['telegram_tag' => 'Неверные логин или пароль'])
                ->withInput();
        }

        session(['auth' => $authData]);
        
        return redirect('/')->with('success', 'Вы успешно вошли в систему');
    }

    /**
     * Выйти из системы
     */
    public function logout()
    {
        session()->forget('auth');
        return redirect('/')->with('success', 'Вы вышли из системы');
    }

    /**
     * Показать форму регистрации
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Обработать регистрацию
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $authData = $this->authService->register($validated);
        session(['auth' => $authData]);

        return redirect('/')->with('success', 'Регистрация успешна!');
    }

    /**
     * Показать профиль пользователя
     */
    public function profile()
    {
        $auth = session('auth');
        
        if (!$auth) {
            return redirect('/login')->with('error', 'Необходимо войти в систему');
        }

        return view('profile', ['auth' => $auth]);
    }

    /**
     * Обновить профиль
     */
    public function updateProfile(ProfileRequest $request)
    {
        $validated = $request->validated();
        $currentAuth = session('auth');

        $authData = $this->authService->updateProfile($validated, $currentAuth);
        session(['auth' => $authData]);

        return back()->with('success', 'Профиль обновлен!');
    }

    /**
     * Показать форму сброса пароля
     */
    public function showResetForm(): View
    {
        return view('auth.reset');
    }

    /**
     * Отправить ссылку для сброса пароля
     */
    public function sendResetLink(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        return back()->with('success', 'Ссылка для сброса пароля отправлена на ваш email');
    }
}
