<x-admin-layout title="Usuarios" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ],
    [
        'name' => 'Crear',
    ],
]">

    <x-wire-card>
        <x-validation-errors class="mb-4" />
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
            <x-wire-input 
                label="Nombre" 
                name="name" 
                placeholder="Nombre completo"
                :value="old('name')">
            </x-wire-input>

            <x-wire-input 
                label="correo electronico" 
                name="email" 
                type="email"
                placeholder="ejemplo@dominio.com"
                autocomplete="email"
                :value="old('email')">
            </x-wire-input>

            <x-wire-input 
                label="Contraseña" 
                name="password" 
                type="password"
                placeholder="Minimo 8 caracteres"
                autocomplete="new-password">
            </x-wire-input>

            <x-wire-input 
                label="Confirmar Contraseña" 
                name="password_confirmation" 
                type="password"
                placeholder="Repite la contraseña"
                autocomplete="new-password">
            </x-wire-input>

            <x-wire-input 
                label="Numero de ID" 
                name="id_number" 
                placeholder="Ej. 12345678"
                autocomplete="off"
                required inputmode="numeric"
                :value="old('phone')">
            </x-wire-input>

            <x-wire-input 
                label="Telefono"
                name="phone"
                placeholder="Ej. 99999999"
                autocomplete="tel"
                required inputmode="tel"
                :value="old('phone')">
            </x-wire-input>

            </div>
            <x-wire-input name="address" label="direccion" placeholder="Ej. Av. Siempre Viva 123" required :value="old('address')" autocomplete="street-address">
            </x-wire-input>

            <div class="space-y-1">
                <x-wire-native-select name="role_id" label="rol" required><option value="">
                    Seleccione un rol
                </option>

            @foreach ($roles as $role)
                <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)> {{ $role->name }}
                </option>
            @endforeach
            </x-wire-native-select>
            <p class="text-sm text-gray-500">
                El rol determina los permisos y el acceso del usuario dentro del sistema.
            </p>

            </div>

            <div class="flex justify-end">
                <x-wire-button type="submit" blue>
                    Guardar
                </x-wire-button>
            </div>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>