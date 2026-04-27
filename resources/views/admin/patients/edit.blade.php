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
<div x-data="{ tab: '{{ $initialTab }}' }">

<!-- menu de pestañas -->


<!-- tab 1: datos personales -->
<li class="me-2">
    <a href="#" @click.prevent="tab = 'datos-personales'"
    :class="{
    'text-blue-600 border-blue-600 active' : tab === 'datos-personales',
    'border-transparent hover:text-blue-600 hover:border-gray-300' : tab !== 'datos-personales'
    }"
     class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group">
        <i class="fa-solid fa-user me-2"></i>
        Datos personales
    </a>
</li>

<!-- tab 2: antecedentes -->
@php $hasError = $errors->hasAny($errorGroups['antecedentes']); 
@endphp
<li class="me-2">
    <a href="#" @click.prevent="tab = 'antecedentes'"
    :class="{
    'text-red-600 border-red-600' : {{$hasError ? 'true' : 'false'}} && tab !== 'antecedentes',
    'text-blue-600 border-blue-600 active' : tab === 'antecedentes' && {{$hasError ? 'true' : 'false'}}, 
    'text-red-600 border-red-600 active' : tab === 'antecedentes' && {{$hasError ? 'true' : 'false'}},
    'border-transparent hover:text-blue-600 hover:border-gray-300' : tab !== 'antecedentes && {{$hasError ? 'true' : 'false'}}',
    }"
     class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200 {{$hasError ? 'text-red 600 border-red-600' : '' }}">
        <i class="fa-solid fa-file-lines me-2"></i>
        Antecedentes
        @if($hasError)
            <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
            @endif
    </a>
</li>

<!-- tab 3: informacion general -->
@php $hasError = $errors->hasAny($errorGroups['informacion-general']); 
@endphp
<li class="me-2">
    <a href="#" @click.prevent="tab = 'informacion-general'"
    :class="{
    'text-red-600 border-red-600' : {{$hasError ? 'true' : 'false'}} && tab !== 'informacion-general',
    'text-blue-600 border-blue-600 active' : tab === 'informacion-general' && {{$hasError ? 'true' : 'false'}}, 
    'text-red-600 border-red-600 active' : tab === 'informacion-general' && {{$hasError ? 'true' : 'false'}},
    'border-transparent hover:text-blue-600 hover:border-gray-300' : tab !== 'informacion-general && {{$hasError ? 'true' : 'false'}}',
    }"
     class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200 {{$hasError ? 'text-red 600 border-red-600' : '' }}">
        <i class="fa-solid fa-info me-2"></i>
        Informacion general
        @if($hasError)
            <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
            @endif
    </a>
</li>

<!-- tab 4: contacto de emergencia -->
@php $hasError = $errors->hasAny($errorGroups['contacto-emergencia']); 
@endphp
<li class="me-2">
    <a href="#" @click.prevent="tab = 'contacto-emergencia'"
    :class="{
    'text-red-600 border-red-600' : {{$hasError ? 'true' : 'false'}} && tab !== 'contacto-emergencia',
    'text-blue-600 border-blue-600 active' : tab === 'contacto-emergencia' && {{$hasError ? 'true' : 'false'}}, 
    'text-red-600 border-red-600 active' : tab === 'contacto-emergencia' && {{$hasError ? 'true' : 'false'}},
    'border-transparent hover:text-blue-600 hover:border-gray-300' : tab !== 'contacto-emergencia && {{$hasError ? 'true' : 'false'}}',
    }"
     class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200 {{$hasError ? 'text-red 600 border-red-600' : '' }}">
        <i class="fa-solid fa-heart me-2"></i>
        Contacto de emergencia
        @if($hasError)
            <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
            @endif
    </a>
</li>


</div>

{{-- contenido de los tabs --}}


{{--Contenido de Tab 1: Datos personales --}}
<div x-show="tab === 'datos-personales'">
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
</div>

{{--Contenido de Tab 2: Antecedentes --}}
<div x-show="tab === 'antecedentes'">
    <div class="grid lg:grid-cols-2 gap-4">

        <div>
            <x-wire-textarea label="Alergias conocidas" name="allergies">
                {{ old('allergies', $patient->allergies) }}
            </x-wire-textarea>
        </div>

        <div>
            <x-wire-textarea label="Enfermedades cronicas" name="chronic_conditions">
                {{ old('chronic_conditions', $patient->chronic_conditions) }}
            </x-wire-textarea>
        </div>

        <div>
            <x-wire-textarea label="Antecedentes quirurgicos" name="surgical_history">
                {{ old('surgical_history', $patient->surgical_history) }}
            </x-wire-textarea>
        </div>

        <div>
            <x-wire-textarea label="Antecedentes familiares" name="family_history">
                {{ old('family_history', $patient->family_history) }}
            </x-wire-textarea>
        </div>

    </div>
</div>

{{--Contenido de Tab 3: Informacion general --}}
<div x-show="tab === 'informacion-general'">

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

    <x-wire-textarea 
        label="Observaciones" 
        name="observations"
    >
        {{ old('observations', $patient->observations) }}
    </x-wire-textarea>

</div>

{{--Contenido de Tab 4: Contacto de emergencia --}}
<div x-show="tab === 'contacto-emergencia'" style="display: none;">
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
            name="emergency_contact_relationship" placeholder="Familiar, Amigo, etc."
            value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}" 
        />
    </div>
</div>

    </div>

</x-wire-card>

</form>
</x-admin-layout>

