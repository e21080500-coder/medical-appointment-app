<x-admin-layout title="Nueva cita">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- COLUMNA IZQUIERDA --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- BUSCADOR --}}
            <x-wire-card>

                <h2 class="text-xl font-bold mb-1">
                    Buscar disponibilidad
                </h2>

                <p class="text-sm text-gray-500 mb-4">
                    Encuentra el horario perfecto para tu cita.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    {{-- Fecha --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Fecha
                        </label>

                        <input
                            type="date"
                            class="w-full border rounded-lg px-3 py-2">
                    </div>

                    {{-- Hora --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Hora
                        </label>

                        <select class="w-full border rounded-lg px-3 py-2">
                            <option>08:00 - 09:00</option>
                            <option>09:00 - 10:00</option>
                            <option>10:00 - 11:00</option>
                        </select>
                    </div>

                    {{-- Especialidad --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Especialidad
                        </label>

                        <select class="w-full border rounded-lg px-3 py-2">
                            <option>Cardiología</option>
                            <option>Pediatría</option>
                            <option>Dermatología</option>
                        </select>
                    </div>

                    {{-- Botón --}}
                    <div class="flex items-end">

                        <button
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg py-2">

                            Buscar disponibilidad

                        </button>

                    </div>

                </div>

            </x-wire-card>

            {{-- DOCTORES DISPONIBLES --}}
            @foreach ($doctors as $doctor)

                <x-wire-card>

                    <div class="flex items-start justify-between">

                        <div class="flex gap-4">

                            {{-- Avatar --}}
                            <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">
                                {{ strtoupper(substr($doctor->user->name, 0, 2)) }}
                            </div>

                            {{-- Info --}}
                            <div>

                                <h3 class="font-bold text-lg">
                                    {{ $doctor->user->name }}
                                </h3>

                                <p class="text-indigo-600 text-sm">
                                    {{ $doctor->specialty }}
                                </p>

                            </div>

                        </div>

                    </div>

                    <hr class="my-4">

                    <h4 class="text-sm font-semibold mb-3">
                        Horarios disponibles:
                    </h4>

                    <div class="flex flex-wrap gap-2">

                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm">
                            08:00
                        </button>

                        <button class="bg-gray-100 hover:bg-indigo-100 px-4 py-2 rounded-lg text-sm">
                            08:30
                        </button>

                        <button class="bg-gray-100 hover:bg-indigo-100 px-4 py-2 rounded-lg text-sm">
                            09:00
                        </button>

                    </div>

                </x-wire-card>

            @endforeach

        </div>

        {{-- COLUMNA DERECHA --}}
        <div>

            <x-wire-card>

                <h2 class="text-xl font-bold mb-6">
                    Resumen de la cita
                </h2>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between">
                        <span class="text-gray-500">Doctor:</span>
                        <span>Dr. Demo</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Fecha:</span>
                        <span>2026-03-11</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Horario:</span>
                        <span>08:00 - 08:15</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-gray-500">Duración:</span>
                        <span>15 minutos</span>
                    </div>

                </div>

                <hr class="my-6">

                {{-- Paciente --}}
                <div class="mb-4">

                    <label class="block text-sm font-medium mb-2">
                        Paciente
                    </label>

                    <select class="w-full border rounded-lg px-3 py-2">

                        @foreach ($patients as $patient)

                            <option>
                                {{ $patient->user->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Motivo --}}
                <div class="mb-6">

                    <label class="block text-sm font-medium mb-2">
                        Motivo de la cita
                    </label>

                    <textarea
                        rows="4"
                        class="w-full border rounded-lg px-3 py-2"
                        placeholder="Escribe el motivo de la consulta..."></textarea>

                </div>

                {{-- Botón --}}
                <button
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold">

                    Confirmar cita

                </button>

            </x-wire-card>

        </div>

    </div>

</x-admin-layout>