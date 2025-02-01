
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Inicio de sesión</h2>
        <h4 class="text-gray-500 dark:text-gray-400 mb-6 uppercase text-center">administradores</h4>
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Correo</label>
                <input 
                    id="email"
                    type="email" 
                    name="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                    placeholder="Ingresa tu correo"
                    required
                >
            </div>
            
            <div class="mb-4">
                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Contraseña</label>
                <div class="relative">
                    <input 
                        id="password"
                        type="password" 
                        name="password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        placeholder="Ingresa tu contraseña"
                        required
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg id="password-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12s4-8 9-8 9 8 9 8-4 8-9 8-9-8-9-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            if (type === 'text') {
                passwordIcon.innerHTML = `
                    <path d="M13.875 18.825c-3.618 0-6.623-3.9-6.875-7.768-3.438 1.125-5.5 3.35-5.5 6.025s5.4 7.25 12.375 7.25 12.125-5.2 12.125-7.25c0-3.075-5.5-6.025-12.125-6.025z"></path>
                `;
            } else {
                passwordIcon.innerHTML = `
                    <path d="M3 12s4-8 9-8 9 8 9 8-4 8-9 8-9-8-9-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                `;
            }
        }
    </script>
</body>
</html>
