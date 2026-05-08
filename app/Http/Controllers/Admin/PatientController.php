<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Http\Controllers\Controller;
use App\Models\BloodType;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.patients.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $bloodTypes = BloodType::all();
        return view('admin.patients.edit', compact('patient', 'bloodTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate(

            // 🔹 REGLAS
            [
                'blood_type_id' => 'nullable|exists:blood_types,id',
                'allergies' => 'nullable|string|min:3|max:255',
                'chronic_conditions' => 'nullable|string|min:3|max:255',
                'surgical_history' => 'nullable|string|min:3|max:255',
                'family_history' => 'nullable|string|min:3|max:255',
                'observations' => 'nullable|string|min:3|max:255',
                'emergency_contact_name' => 'nullable|string|min:3|max:255',

                'emergency_contact_phone' => [
                    'nullable',
                    'string',
                    'min:10',
                    'max:12',
                ],

                'emergency_contact_relationship' => 'nullable|string|min:3|max:50',
            ],

            // 🔴 MENSAJES EN ESPAÑOL
            [
                '*.min' => 'El campo :attribute debe tener al menos :min caracteres.',
                '*.max' => 'El campo :attribute no debe tener más de :max caracteres.',
                '*.string' => 'El campo :attribute debe ser texto válido.',
                '*.exists' => 'El valor seleccionado en :attribute no es válido.',
            ],

            // 🧠 NOMBRES BONITOS
            [
                'blood_type_id' => 'tipo de sangre',
                'allergies' => 'alergias',
                'chronic_conditions' => 'enfermedades crónicas',
                'surgical_history' => 'antecedentes quirúrgicos',
                'family_history' => 'antecedentes familiares',
                'observations' => 'observaciones',
                'emergency_contact_name' => 'nombre del contacto',
                'emergency_contact_phone' => 'teléfono del contacto',
                'emergency_contact_relationship' => 'relación del contacto',
            ]
        );

        $patient->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente actualizado',
            'text' => 'El paciente ha sido actualizado exitosamente'
        ]);

        return redirect()->route('admin.patients.edit', $patient)
            ->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}