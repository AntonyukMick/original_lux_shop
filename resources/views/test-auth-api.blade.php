@extends('layouts.app')

@section('title', 'Тест API авторизации')

@section('content')
<div class="container">
    <div class="panel">
        <h2>🧪 Тест API авторизации</h2>
        
        <div style="margin-bottom: 24px;">
            <button onclick="testAuth()" style="background: #527ea6; color: white; padding: 12px 24px; border-radius: 8px; border: none; cursor: pointer; font-weight: bold;">
                🔍 Проверить авторизацию
            </button>
        </div>

        <div id="auth-result" style="background: #f8fafc; padding: 16px; border-radius: 8px; min-height: 100px;">
            <p>Нажмите кнопку выше для проверки авторизации</p>
        </div>

        <div style="margin-top: 24px;">
            <h3>📋 Инструкция:</h3>
            <ol>
                <li>Сначала войдите в систему через <a href="/login">страницу входа</a></li>
                <li>Затем вернитесь сюда и нажмите "Проверить авторизацию"</li>
                <li>Посмотрите результат в блоке выше</li>
            </ol>
        </div>
    </div>
</div>

<script>
function testAuth() {
    const resultDiv = document.getElementById('auth-result');
    resultDiv.innerHTML = '<p>⏳ Проверяем авторизацию...</p>';
    
    fetch('{{ route("api.current-user") }}')
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            
            let html = '<h3>📊 Результат проверки:</h3>';
            html += '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
            
            if (data.authenticated) {
                html += '<div style="background: #d1fae5; padding: 12px; border-radius: 6px; margin-top: 12px;">';
                html += '<p style="margin: 0; color: #065f46;">✅ Пользователь авторизован!</p>';
                html += '</div>';
            } else {
                html += '<div style="background: #fef3c7; padding: 12px; border-radius: 6px; margin-top: 12px;">';
                html += '<p style="margin: 0; color: #92400e;">❌ Пользователь не авторизован</p>';
                html += '</div>';
            }
            
            resultDiv.innerHTML = html;
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = '<div style="background: #fee2e2; padding: 12px; border-radius: 6px;"><p style="margin: 0; color: #dc2626;">❌ Ошибка: ' + error.message + '</p></div>';
        });
}
</script>
@endsection
