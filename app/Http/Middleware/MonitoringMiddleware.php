<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MonitoringMiddleware
{
    /**
     * Handle an incoming request.
     * Логирует запросы для мониторинга производительности и безопасности
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        // Логируем входящий запрос
        Log::info('Request started', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'timestamp' => now()->toISOString()
        ]);
        
        $response = $next($request);
        
        $endTime = microtime(true);
        $executionTime = round(($endTime - $startTime) * 1000, 2); // в миллисекундах
        
        // Логируем ответ
        Log::info('Request completed', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'status_code' => $response->getStatusCode(),
            'execution_time_ms' => $executionTime,
            'memory_usage_mb' => round(memory_get_peak_usage(true) / 1024 / 1024, 2),
            'timestamp' => now()->toISOString()
        ]);
        
        // Добавляем заголовки для мониторинга
        $response->headers->set('X-Execution-Time', $executionTime . 'ms');
        $response->headers->set('X-Memory-Usage', round(memory_get_peak_usage(true) / 1024 / 1024, 2) . 'MB');
        
        // Предупреждение о медленных запросах
        if ($executionTime > 1000) { // больше 1 секунды
            Log::warning('Slow request detected', [
                'url' => $request->fullUrl(),
                'execution_time_ms' => $executionTime,
                'method' => $request->method()
            ]);
        }
        
        return $response;
    }
}
