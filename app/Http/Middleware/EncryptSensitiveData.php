<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class EncryptSensitiveData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Если это ответ с данными пользователя, шифруем чувствительные поля
        if ($response->headers->get('Content-Type') === 'application/json') {
            $content = $response->getContent();
            $data = json_decode($content, true);
            
            if (is_array($data) && isset($data['user'])) {
                // Шифруем чувствительные данные пользователя
                if (isset($data['user']['phone'])) {
                    $data['user']['phone'] = Crypt::encryptString($data['user']['phone']);
                }
                if (isset($data['user']['address'])) {
                    $data['user']['address'] = Crypt::encryptString($data['user']['address']);
                }
                
                $response->setContent(json_encode($data));
            }
        }

        return $response;
    }
}
