@extends('layouts.app')

@section('title', 'Citas de Usuario')

@section('header', 'Citas de Usuario')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="bg-white rounded-lg shadow-lg p-6">
        
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
        @endif

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Citas de {{ $user->name }}</h1>
        <a href="{{ route('admin.user.appointments.create', $user->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-4 inline-block">
            Crear nueva cita
        </a>

        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($appointments as $appointment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $appointment->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->time }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $appointment->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $appointment->status->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.user.appointments.edit', [$user->id, $appointment->id]) }}" class="text-blue-600 hover:text-blue-900">Editar</a>
                            <form action="{{ route('admin.user.appointments.destroy', [$user->id, $appointment->id]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-900 ml-4" onclick="confirmDelete(event)">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </div>
</div>


<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-gray-800 mb-4">¿Estás seguro?</h2>
        <p class="text-gray-600 mb-6">¿Deseas eliminar esta cita?</p>
        <div class="flex justify-end space-x-4">
            <button id="confirmCancel" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancelar</button>
            <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Eliminar</button>
        </div>
    </div>
</div>

<script>
    function confirmDelete(event) {
        console.log('confirmDelete ejecutado');
        const form = event.target.closest('form');
        const modal = document.getElementById('confirmModal');


        modal.classList.remove('hidden');


        document.getElementById('confirmDelete').onclick = function() {
            form.submit();
            modal.classList.add('hidden');
        };


        document.getElementById('confirmCancel').onclick = function() {
            modal.classList.add('hidden');
        };
    }
</script>
@endsection