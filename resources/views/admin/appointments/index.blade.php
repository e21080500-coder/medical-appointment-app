<x-admin-layout title="Citas médicas">

    <x-wire-card>

        {{-- ENCABEZADO --}}
        <div class="flex justify-between items-center mb-6">

            <div>

                <p class="text-sm text-gray-400">
                    Dashboard / Citas
                </p>

                <h1 class="text-3xl font-bold text-gray-800">
                    Citas
                </h1>

            </div>

            {{-- BOTON NUEVA --}}
            <x-wire-button
                href="{{ route('admin.appointments.create') }}"
                primary>

                + Nueva

            </x-wire-button>

        </div>

        {{-- BARRA SUPERIOR --}}
        <div class="flex justify-between items-center mb-4">

            {{-- BUSCADOR --}}
            <div class="w-72">

                <input
                    type="text"
                    placeholder="Buscar"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">

            </div>

            {{-- SELECTORES --}}
            <div class="flex gap-2">

                <select class="border border-gray-300 rounded-lg px-3 py-2">

                    <option>
                        Columnas
                    </option>

                </select>

                <select class="border border-gray-300 rounded-lg px-3 py-2">

                    <option>10</option>
                    <option>25</option>
                    <option>50</option>

                </select>

            </div>

        </div>

        {{-- TABLA --}}
        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">

                {{-- HEAD --}}
                <thead class="border-b bg-gray-50">

                    <tr>

                        <th class="text-left py-3 px-2">
                            ID
                        </th>

                        <th class="text-left py-3 px-2">
                            Paciente
                        </th>

                        <th class="text-left py-3 px-2">
                            Doctor
                        </th>

                        <th class="text-left py-3 px-2">
                            Fecha
                        </th>

                        <th class="text-left py-3 px-2">
                            Hora
                        </th>

                        <th class="text-left py-3 px-2">
                            Estado
                        </th>

                        <th class="text-left py-3 px-2">
                            Acciones
                        </th>

                    </tr>

                </thead>

                {{-- BODY --}}
                <tbody>

                    @forelse ($appointments as $appointment)

                        <tr class="border-b hover:bg-gray-50">

                            {{-- ID --}}
                            <td class="py-3 px-2">

                                {{ $appointment->id }}

                            </td>

                            {{-- PACIENTE --}}
                            <td class="py-3 px-2">

                                {{ $appointment->patient->user->name ?? 'Sin paciente' }}

                            </td>

                            {{-- DOCTOR --}}
                            <td class="py-3 px-2">

                                {{ $appointment->doctor->user->name ?? 'Sin doctor' }}

                            </td>

                            {{-- FECHA --}}
                            <td class="py-3 px-2">

                                {{ $appointment->appointment_date ?? 'Sin fecha' }}

                            </td>

                            {{-- HORA --}}
                            <td class="py-3 px-2">

                                {{ $appointment->start_time ?? '09:00' }}

                            </td>

                            {{-- ESTADO --}}
                            <td class="py-3 px-2">

                                @if($appointment->status == 'Pendiente')

                                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">

                                        Pendiente

                                    </span>

                                @elseif($appointment->status == 'Finalizada')

                                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">

                                        Finalizada

                                    </span>

                                @elseif($appointment->status == 'En proceso')

                                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">

                                        En proceso

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 text-xs px-3 py-1 rounded-full">

                                        Cancelada

                                    </span>

                                @endif

                            </td>

                            {{-- ACCIONES --}}
                            <td class="py-3 px-2">

                                <div class="flex gap-2">

                                    {{-- BOTON EDITAR --}}
                                    <x-wire-button
                                        blue
                                        icon="pencil"
                                        href="{{ route('admin.appointments.edit', $appointment) }}"
                                    />

                                    {{-- BOTON VER CONSULTA --}}
                                    <x-wire-button
                                        emerald
                                        icon="eye"
                                        href="{{ route('admin.appointments.edit', $appointment) }}"
                                    />

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-6 text-gray-400">

                                No hay citas registradas

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- FOOTER --}}
        <div class="flex justify-between items-center mt-4 text-sm text-gray-500">

            <p>

                Mostrando {{ $appointments->count() }} resultados

            </p>

            <div class="flex gap-1">

                <button class="border px-3 py-1 rounded">
                    1
                </button>

                <button class="border px-3 py-1 rounded">
                    2
                </button>

                <button class="border px-3 py-1 rounded">
                    3
                </button>

            </div>

        </div>

    </x-wire-card>

</x-admin-layout>