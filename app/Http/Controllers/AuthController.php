<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ProfileRequest;
use App\Services\AuthService;
use App\Services\UserActivityService;
use Illuminate\View\View;

class AuthController extends Controller
{
    protected $authService;
    protected $activityService;

    public function __construct(AuthService $authService, UserActivityService $activityService)
    {
        $this->authService = $authService;
        $this->activityService = $activityService;
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
            // Логируем неудачную попытку входа
            $this->activityService->logActivity('login_failed', null, [
                'telegram_tag' => $validated['telegram_tag'],
                'reason' => 'invalid_credentials'
            ], $request);
            
            return back()->withErrors(['telegram_tag' => 'Неверный Telegram тег или пароль'])
                ->withInput();
        }

        session(['auth' => $authData]);
        
        // Логируем успешный вход
        $this->activityService->logLogin($authData['id'], $authData['telegram_tag'], $request);
        
        return redirect('/')->with('success', 'Вы успешно вошли в систему');
    }

    /**
     * Выйти из системы
     */
    public function logout()
    {
        $authData = session('auth');
        if ($authData) {
            // Логируем выход
            $this->activityService->logLogout($authData['id']);
        }
        
        $this->authService->logout();
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

        // Логируем регистрацию
        $this->activityService->logRegistration($authData['id'], $authData['telegram_tag'], $request);

        return redirect('/')->with('success', 'Регистрация успешна!');
    }

    /**
     * Показать профиль пользователя
     */
    public function profile(): View
    {
        $auth = session('auth');
        if (!$auth) {
            return redirect()->route('auth.login');
        }

        return view('profile', compact('auth'));
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

    /**
     * Получить данные текущего пользователя для API
     */
    public function getCurrentUser()
    {
        if (!auth()->check()) {
            return response()->json([
                'authenticated' => false,
                'user' => null
            ]);
        }

        $user = auth()->user();
        
        return response()->json([
            'authenticated' => true,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'telegram_tag' => $user->telegram_tag ?? ''
            ]
        ]);
    }
}
