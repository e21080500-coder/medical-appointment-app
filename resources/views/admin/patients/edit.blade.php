{{-- Logica de php para manejar errores y controlar la pestaña activa --}}

@php
//definimos que campos pertenecen a cada pestana para detectar errores
$errorGroups = [
'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
'informacion-general' => ['blood_type_id', 'observations'],
'contacto-emergencia' => ['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship'],
];

//pestana por defecto
$initialTab = 'datos-personales';

//si hay errores, buscamos en que grupo estan para abrir esta pestana automaticamente
foreach ($errorGroups as $tabName => $fields) {
if ($errors->hasAny($fields)) {
$initialTab = $tabName;
break;
}
}
@endphp

<x-admin-layout title="Pacientes" :breadcrumbs="[
 [
     'name' => 'Dashboard',
     'href' => route('admin.dashboard'),
 ],
 [
     'name' => 'Pacientes',
     'href' => route('admin.patients.index'),
 ],
 [
     'name' => 'Editar',
 ],
]">

<form action="{{ route('admin.patients.update', $patient) }}" method="POST">
@csrf
@method('PUT')

<x-wire-card>
    <div class="flex justify-between items-center">

    <!-- IZQUIERDA: FOTO + NOMBRE -->
    <div class="flex items-center space-x-4">
        <img src="{{ $patient->user->profile_photo_url }}"
             alt="{{ $patient->user->name }}"
             class="h-20 w-20 rounded-full object-cover">

        <p class="text-2xl font-bold text-gray-900">
            {{ $patient->user->name }}
        </p>
    </div>

    <!-- DERECHA: BOTONES -->
    <div class="flex space-x-3">
        <x-wire-button outline gray href="{{ route('admin.patients.index') }}">
            Volver
        </x-wire-button>

        <x-wire-button type="submit">
            <i class="fa-solid fa-check"></i>
            Guardar cambios
        </x-wire-button>
    </div>

</div>


</x-wire-card>

<!-- Tabs de navegacion -->

<x-wire-card>

<x-tabs :initialTab="$initialTab">


<!-- menu de pestañas -->
<x-slot name="header">

    <!-- tab 1: datos personales -->
    <x-tab-link name="datos-personales">
        <i class="fa-solid fa-user me-2"></i>
        Datos personales
    </x-tab-link>

    <!-- tab 2: antecedentes -->
    @php $hasError = $errors->hasAny($errorGroups['antecedentes']); @endphp
    <x-tab-link name="antecedentes" :error="$hasError">
        <i class="fa-solid fa-file-lines me-2"></i>
        Antecedentes
    </x-tab-link>

    <!-- tab 3: informacion general -->
    @php $hasError = $errors->hasAny($errorGroups['informacion-general']); @endphp
    <x-tab-link name="informacion-general" :error="$hasError">
        <i class="fa-solid fa-info me-2"></i>
        Información general
    </x-tab-link>

    <!-- tab 4: contacto de emergencia -->
    @php $hasError = $errors->hasAny($errorGroups['contacto-emergencia']); @endphp
    <x-tab-link name="contacto-emergencia" :error="$hasError">
        <i class="fa-solid fa-heart me-2"></i>
        Contacto de emergencia
    </x-tab-link>

</x-slot>

{{-- contenido de los tabs --}}

{{--Contenido de Tab 1: Datos personales --}}
<x-tab-content name="datos-personales">
    <div class="grid lg:grid-cols-2 gap-4">
        <div>
            <span class="text-gray-500 font-semibold">Teléfono: </span>
            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->phone }}</span>
        </div>
        <div>
            <span class="text-gray-500 font-semibold">Email: </span>
            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->email }}</span>
        </div>
        <div>
            <span class="text-gray-500 font-semibold">Direccion: </span>
            <span class="text-gray-900 text-sm ml-1">{{ $patient->user->address }}</span>
        </div>
    </div>
</x-tab-content>

{{--Contenido de Tab 2: Antecedentes --}}
<x-tab-content name="antecedentes">
    <div class="grid lg:grid-cols-2 gap-4">

        <x-wire-textarea label="Alergias conocidas" name="allergies">
            {{ old('allergies', $patient->allergies) }}
        </x-wire-textarea>

        <x-wire-textarea label="Enfermedades cronicas" name="chronic_conditions">
            {{ old('chronic_conditions', $patient->chronic_conditions) }}
        </x-wire-textarea>

        <x-wire-textarea label="Antecedentes quirurgicos" name="surgical_history">
            {{ old('surgical_history', $patient->surgical_history) }}
        </x-wire-textarea>

        <x-wire-textarea label="Antecedentes familiares" name="family_history">
            {{ old('family_history', $patient->family_history) }}
        </x-wire-textarea>

    </div>
</x-tab-content>

{{--Contenido de Tab 3: Informacion general --}}
<x-tab-content name="informacion-general">

    <x-wire-native-select 
        label="Tipo de Sangre" 
        class="mb-4" 
        name="blood_type_id"
    >
        <option value="">Selecciona un tipo de sangre</option>

        @foreach ($bloodTypes as $bloodType)
            <option 
                value="{{ $bloodType->id }}"
                @selected(old('blood_type_id', $patient->blood_type_id) == $bloodType->id)
            >
                {{ $bloodType->name }}
            </option>
        @endforeach

    </x-wire-native-select>

    <x-wire-textarea label="Observaciones" name="observations">
        {{ old('observations', $patient->observations) }}
    </x-wire-textarea>

</x-tab-content>

{{--Contenido de Tab 4: Contacto de emergencia --}}
<x-tab-content name="contacto-emergencia">
    <div class="space-y-4">

        <x-wire-input 
            label="Nombre de contacto" 
            name="emergency_contact_name"
            value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}" 
        />

        <x-wire-phone 
            label="Teléfono de contacto"
            name="emergency_contact_phone"
            placeholder="Ingrese teléfono"
            value="{{ old('emergency_contact_phone', $patient->emergency_contact_phone) }}"
        />

        <x-wire-input 
            label="Relación con el contacto" 
            name="emergency_contact_relationship"
            placeholder="Familiar, Amigo, etc."
            value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}" 
        />

    </div>
</x-tab-content>


</x-tabs>

</x-wire-card>

</form>
</x-admin-layout>
