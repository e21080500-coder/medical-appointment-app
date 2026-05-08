<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Mostrar listado
     */
    public function index()
    {
        // Obtenemos todos los doctores con su usuario relacionado
        $doctors = Doctor::with('user')->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Formulario crear
     */
    public function create()
    {
        // Solo usuarios que aun no sean doctores
        $users = User::doesntHave('doctor')->get();

        return view('admin.doctors.create', compact('users'));
    }

    /**
     * Guardar doctor
     */
    public function store(Request $request)
    {
        $data = $request->validate(

            [
                'user_id' => 'required|exists:users,id',
                'specialty' => 'required|string|max:255',
                'professional_license' => 'required|string|max:255|unique:doctors,professional_license',
                'biography' => 'nullable|string',
            ],

            [
                '*.required' => 'El campo :attribute es obligatorio.',
                '*.max' => 'El campo :attribute no debe superar :max caracteres.',
                '*.unique' => 'Este valor ya está registrado.',
            ],

            [
                'user_id' => 'usuario',
                'specialty' => 'especialidad',
                'professional_license' => 'cédula profesional',
                'biography' => 'biografía',
            ]
        );

        // Crear doctor
        Doctor::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Doctor registrado',
            'text' => 'El doctor fue registrado correctamente'
        ]);

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Editar doctor
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Actualizar doctor
     */
    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate(

            [
                'specialty' => 'required|string|max:255',

                'professional_license' =>
                    'required|string|max:255|unique:doctors,professional_license,' . $doctor->id,

                'biography' => 'nullable|string',
            ],

            [
                '*.required' => 'El campo :attribute es obligatorio.',
                '*.max' => 'El campo :attribute no debe superar :max caracteres.',
            ],

            [
                'specialty' => 'especialidad',
                'professional_license' => 'cédula profesional',
                'biography' => 'biografía',
            ]
        );

        // Actualizar doctor
        $doctor->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Doctor actualizado',
            'text' => 'Los datos fueron actualizados correctamente'
        ]);

        return redirect()->route('admin.doctors.index');
    }

    /**
     * Eliminar doctor
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Doctor eliminado',
            'text' => 'El doctor fue eliminado correctamente'
        ]);

        return redirect()->route('admin.doctors.index');
    }

    public function schedule(Doctor $doctor)
{
    return view('admin.doctors.schedule', compact('doctor'));
}
}