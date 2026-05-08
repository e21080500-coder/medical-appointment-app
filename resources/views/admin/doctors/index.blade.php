<x-admin-layout title="Doctores">

    <x-wire-card>

        <div class="flex justify-between items-center mb-4">

            <h1 class="text-2xl font-bold">
                Doctores
            </h1>

            <x-wire-button
                href="{{ route('admin.doctors.create') }}"
                primary>

                Nuevo doctor

            </x-wire-button>

        </div>

        <table class="min-w-full">

            <thead class="border-b">

                <tr>

                    <th class="text-left py-2">Doctor</th>
                    <th class="text-left py-2">Especialidad</th>
                    <th class="text-left py-2">Cédula</th>
                    <th class="text-left py-2">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($doctors as $doctor)

                    <tr class="border-b">

                        <td class="py-3">
                            {{ $doctor->user->name }}
                        </td>

                        <td>
                            {{ $doctor->specialty }}
                        </td>

                        <td>
                            {{ $doctor->professional_license }}
                        </td>

                        <td class="flex gap-2 py-2">

                            {{-- Botón editar --}}
                            <x-wire-button
                                blue
                                icon="pencil"
                                href="{{ route('admin.doctors.edit', $doctor) }}"
                            />

                            {{-- Botón horarios --}}
                            <x-wire-button
                                emerald
                                icon="calendar-days"
                                href="{{ route('admin.doctors.schedule', $doctor) }}"
                            />

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </x-wire-card>

</x-admin-layout>