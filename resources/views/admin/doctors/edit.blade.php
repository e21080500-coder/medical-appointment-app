<x-admin-layout title="Editar Doctor">

<form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">

    @csrf
    @method('PUT')

    <x-wire-card>

        <div class="flex justify-between items-center mb-6">

            <div class="flex items-center gap-4">

                <img
                    src="{{ $doctor->user->profile_photo_url }}"
                    class="w-20 h-20 rounded-full object-cover"
                >

                <div>

                    <h1 class="text-2xl font-bold">
                        {{ $doctor->user->name }}
                    </h1>

                    <p class="text-gray-500">
                        {{ $doctor->user->email }}
                    </p>

                </div>

            </div>

            <x-wire-button
                href="{{ route('admin.doctors.index') }}"
                gray
                outline>

                Volver

            </x-wire-button>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-wire-input
                label="Especialidad"
                name="specialty"
                value="{{ old('specialty', $doctor->specialty) }}"
            />

            <x-wire-input
                label="Cédula profesional"
                name="professional_license"
                value="{{ old('professional_license', $doctor->professional_license) }}"
            />

        </div>

        <div class="mt-4">

            <x-wire-textarea
                label="Biografía"
                name="biography"
            >
                {{ old('biography', $doctor->biography) }}
            </x-wire-textarea>

        </div>

        <div class="flex justify-end mt-6">

            <x-wire-button type="submit">

                Guardar cambios

            </x-wire-button>

        </div>

    </x-wire-card>

</form>

</x-admin-layout>