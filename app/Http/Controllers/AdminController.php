<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Status;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Solo los administradores pueden acceder.');
        }

        return redirect()->route('admin.login')->with('error', 'Credenciales inválidas.');
    }

    public function dashboard(Request $request)
    {
        $field = $request->query('field', 'name');
        $search = $request->query('search');

        $users = User::query();

        if ($search) {
            $users->where($field, 'like', "%{$search}%");
        }

        $users = $users->paginate(10);

        return view('admin.dashboard', compact('users', 'field', 'search'));
    }

    public function userAppointments($id)
    {
        $user = User::findOrFail($id);
        $appointments = $user->appointments()->with('status')->paginate(10);

        return view('admin.user_appointments', compact('user', 'appointments'));
    }

    public function createAppointment($userId)
    {
        $user = User::findOrFail($userId);
        $statuses = Status::all();

        return view('admin.appointments.create', compact('user', 'statuses'));
    }

    public function storeAppointment(Request $request, $userId)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $user = User::findOrFail($userId);

        $user->appointments()->create($request->all());

        return redirect()->route('admin.user.appointments', $user->id)->with('success', 'Cita creada correctamente.');
    }

    public function editAppointment($userId, $appointmentId)
    {
        $user = User::findOrFail($userId);

        $appointment = $user->appointments()->findOrFail($appointmentId);

        $statuses = Status::all();

        return view('admin.appointments.edit', compact('user', 'appointment', 'statuses'));
    }

    public function updateAppointment(Request $request, $userId, $appointmentId)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'required|string',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $user = User::findOrFail($userId);

        $appointment = $user->appointments()->findOrFail($appointmentId);

        $appointment->update($request->all());

        return redirect()->route('admin.user.appointments', $user->id)->with('success', 'Cita actualizada correctamente.');
    }

    public function destroyAppointment($userId, $appointmentId)
    {
        $user = User::findOrFail($userId);

        $appointment = $user->appointments()->findOrFail($appointmentId);

        $appointment->delete();

        return redirect()->route('admin.user.appointments', $user->id)->with('success', 'Cita eliminada correctamente.');
    }
}
