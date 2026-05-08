<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.schedules', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor->schedules()->delete();

        if ($request->schedules) {

            foreach ($request->schedules as $schedule) {

                $doctor->schedules()->create([
                    'day' => $schedule['day'],
                    'start_time' => $schedule['start_time'],
                    'end_time' => $schedule['end_time'],
                ]);
            }
        }

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Horarios guardados',
            'text' => 'Los horarios del doctor fueron actualizados'
        ]);

        return redirect()->back();
    }
}