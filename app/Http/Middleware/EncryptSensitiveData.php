<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EncryptSensitiveData
{
    /**
     * Handle an incoming request.
     * Шифрует чувствительные данные в JSON ответах
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Проверяем, является ли ответ JSON
        if ($response->headers->get('Content-Type') === 'application/json') {
            try {
                $content = $response->getContent();
                $data = json_decode($content, true);
                
                if (is_array($data)) {
                    $data = $this->encryptSensitiveFields($data);
                    $response->setContent(json_encode($data));
                }
            } catch (\Exception $e) {
                Log::error('Error encrypting sensitive data', [
                    'error' => $e->getMessage(),
                    'url' => $request->fullUrl()
                ]);
            }
        }

        return $response;
    }
    
    /**
     * Рекурсивно шифрует чувствительные поля в массиве данных
     */
    private function encryptSensitiveFields(array $data): array
    {
        $sensitiveFields = ['phone', 'address', 'email', 'password', 'credit_card', 'ssn'];
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->encryptSensitiveFields($value);
            } elseif (in_array(strtolower($key), $sensitiveFields) && !empty($value)) {
                try {
                    $data[$key] = Crypt::encryptString($value);
                } catch (\Exception $e) {
                    Log::warning('Failed to encrypt sensitive field', [
                        'field' => $key,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
        
        return $data;
    }
}