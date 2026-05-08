<x-admin-layout title="Horarios">

    <x-wire-card>

        <div class="flex justify-between items-center mb-6">

            <div>
                <h1 class="text-2xl font-bold">
                    Gestor de horarios
                </h1>

                <p class="text-gray-500">
                    Doctor: {{ $doctor->user->name }}
                </p>
            </div>

            <x-wire-button primary>
                Guardar horario
            </x-wire-button>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full border">

                <thead class="bg-gray-100">

                    <tr>
                        <th class="p-3 border">Hora</th>
                        <th class="p-3 border">Lunes</th>
                        <th class="p-3 border">Martes</th>
                        <th class="p-3 border">Miércoles</th>
                        <th class="p-3 border">Jueves</th>
                        <th class="p-3 border">Viernes</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ([
                        '08:00',
                        '09:00',
                        '10:00',
                        '11:00',
                        '12:00'
                    ] as $hour)

                    <tr>

                        <td class="p-3 border font-semibold">
                            {{ $hour }}
                        </td>

                        @for ($i = 0; $i < 5; $i++)

                            <td class="p-3 border text-center">

                                <input type="checkbox">

                            </td>

                        @endfor

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </x-wire-card>

</x-admin-layout>