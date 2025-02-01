<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();

        return response()->json([
            'status' => true,
            'data' => $appointments,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'description' => 'required|string|max:255',
            'status_id' => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cita creada exitosamente',
            'data' => $appointment,
        ], 201);
    }

    public function show($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())->find($id);

        if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $appointment,
        ]);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::where('user_id', Auth::id())->find($id);

        if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'sometimes|date',
            'time' => 'sometimes|date_format:H:i',
            'description' => 'sometimes|string|max:255',
            'status_id' => 'sometimes|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $appointment->update($request->only(['date', 'time', 'description', 'status_id']));

        return response()->json([
            'status' => true,
            'message' => 'Cita actualizada exitosamente',
            'data' => $appointment,
        ]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::where('user_id', Auth::id())->find($id);

        if (!$appointment) {
            return response()->json([
                'status' => false,
                'message' => 'Cita no encontrada',
            ], 404);
        }

        $appointment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cita eliminada correctamente',
        ]);
    }
}
