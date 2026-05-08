<x-admin-layout title="Crear Doctor">

<form action="{{ route('admin.doctors.store') }}" method="POST">

    @csrf

    <x-wire-card>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-wire-native-select
                label="Usuario"
                name="user_id"
            >

                <option value="">
                    Selecciona un usuario
                </option>

                @foreach ($users as $user)

                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>

                @endforeach

            </x-wire-native-select>

            <x-wire-input
                label="Especialidad"
                name="specialty"
                value="{{ old('specialty') }}"
            />

            <x-wire-input
                label="Cédula profesional"
                name="professional_license"
                value="{{ old('professional_license') }}"
            />

        </div>

        <div class="mt-4">

            <x-wire-textarea
                label="Biografía"
                name="biography"
            >
                {{ old('biography') }}
            </x-wire-textarea>

        </div>

        <div class="flex justify-end mt-4">

            <x-wire-button type="submit">
                Guardar doctor
            </x-wire-button>

        </div>

    </x-wire-card>

</form>

</x-admin-layout>