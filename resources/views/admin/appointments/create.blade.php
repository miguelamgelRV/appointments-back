@extends('layouts.app')

@section('title', 'Crear Cita')

@section('header', 'Crear Cita')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Crear nueva cita para {{ $user->name }}</h1>
        <form action="{{ route('admin.user.appointments.store', $user->id) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
            </div>

            
            <div class="mb-4">
                <label for="time" class="block text-sm font-medium text-gray-700">Hora</label>
                <input
                    type="time"
                    name="time"
                    id="time"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
            </div>

            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea
                    name="description"
                    id="description"
                    rows="3"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                ></textarea>
            </div>

            
            <div class="mb-6">
                <label for="status_id" class="block text-sm font-medium text-gray-700">Estado</label>
                <select
                    name="status_id"
                    id="status_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
                    @foreach ($statuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Crear cita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection