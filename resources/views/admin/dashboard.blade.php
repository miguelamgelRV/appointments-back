<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Bienvenido, {{ Auth::user()->name }} 
                </h1>
            </div>
        </header>

        
        <main class="flex-grow">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-6">
                            Usuarios
                        </h2>

                        
                        <div class="mb-6">
                            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex items-center space-x-4">
                                
                                <select name="field" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="name" {{ request('field') == 'name' ? 'selected' : '' }}>Nombre</option>
                                    <option value="email" {{ request('field') == 'email' ? 'selected' : '' }}>Correo</option>
                                    <option value="role" {{ request('field') == 'role' ? 'selected' : '' }}>Rol</option>
                                </select>

                                
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Buscar..."
                                    value="{{ request('search') }}"
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">

                                
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    Buscar
                                </button>

                                
                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                    Limpiar
                                </a>
                            </form>
                        </div>

                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Correo
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rol
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $user->role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if ($user->role != 'admin')
                                            <a href="{{ route('admin.user.appointments', $user->id) }}" class="text-teal-500 hover:text-teal-900 mx-1">Ver citas</a>
                                            @endif
                                            <a href="#" class="text-blue-600 hover:text-blue-900 mx-1">Editar</a>
                                            <a href="#" class="text-red-600 hover:text-red-900 mx-1">Eliminar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        
                        <div class="mt-4">
                            {{ $users->links() }} 
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white shadow mt-auto">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-sm text-gray-500">

                </p>
            </div>
        </footer>
    </div>
</body>

</html>