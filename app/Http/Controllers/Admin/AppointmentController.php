<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        $appointments = Appointment::with([
            'patient.user',
            'doctor.user'
        ])->latest()->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        $patients = Patient::with('user')->get();

        $doctors = Doctor::with('user')->get();

        return view('admin.appointments.create', compact(
            'patients',
            'doctors'
        ));
    }

    /**
     * Guardar cita
     */
    public function store(Request $request)
    {
        $data = $request->validate([

            'patient_id' => 'required|exists:patients,id',

            'doctor_id' => 'required|exists:doctors,id',

            'appointment_date' => 'required|date',

            'start_time' => 'required',

            'end_time' => 'required',

            'reason' => 'required|string|max:255',

        ], [

            '*.required' => 'El campo :attribute es obligatorio.',

        ], [

            'patient_id' => 'paciente',
            'doctor_id' => 'doctor',
            'appointment_date' => 'fecha',
            'start_time' => 'hora inicio',
            'end_time' => 'hora fin',
            'reason' => 'motivo',
        ]);

        Appointment::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita registrada',
            'text' => 'La cita fue creada correctamente'
        ]);

        return redirect()->route('admin.appointments.index');
    }

    /**
     * Editar cita
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patient::with('user')->get();

        $doctors = Doctor::with('user')->get();

        return view('admin.appointments.edit', compact(
            'appointment',
            'patients',
            'doctors'
        ));
    }

    /**
     * Actualizar cita
     */
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([

            'patient_id' => 'required|exists:patients,id',

            'doctor_id' => 'required|exists:doctors,id',

            'appointment_date' => 'required|date',

            'start_time' => 'required',

            'end_time' => 'required',

            'reason' => 'required|string|max:255',

            'status' => 'required',

            'symptoms' => 'nullable|string',

            'diagnosis' => 'nullable|string',

            'treatment' => 'nullable|string',

            'notes' => 'nullable|string',

        ]);

        $appointment->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita actualizada',
            'text' => 'La cita fue actualizada correctamente'
        ]);

        return redirect()->route('admin.appointments.index');
    }

    /**
     * Eliminar cita
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita eliminada',
            'text' => 'La cita fue eliminada correctamente'
        ]);

        return redirect()->route('admin.appointments.index');
    }
}