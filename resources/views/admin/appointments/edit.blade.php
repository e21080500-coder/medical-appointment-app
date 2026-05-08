<x-admin-layout title="Editar cita">

<form
    action="{{ route('admin.appointments.update', $appointment) }}"
    method="POST">

    @csrf
    @method('PUT')

    <x-wire-card>

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">

            <div>

                <p class="text-sm text-gray-400 mb-1">
                    Dashboard / Citas / Consulta
                </p>

                <h1 class="text-3xl font-bold text-gray-800">
                    Consulta
                </h1>

                <p class="text-gray-500 mt-1">
                    {{ $appointment->patient->user->name }}
                </p>

            </div>

            <div class="flex gap-2">

                {{-- BOTON HISTORIAL --}}
                <x-wire-button
                    gray
                    outline
                    type="button">

                    Historia médica del paciente

                </x-wire-button>

                {{-- BOTON CONSULTAS --}}
                <x-wire-button
                    gray
                    outline
                    type="button">

                    Consultas anteriores

                </x-wire-button>

            </div>

        </div>

        {{-- TABS --}}
        <div
            x-data="{ tab: 'consulta' }"
            class="w-full">

            {{-- BOTONES TABS --}}
            <div class="border-b mb-6">

                <div class="flex gap-6">

                    {{-- TAB CONSULTA --}}
                    <button
                        type="button"
                        @click="tab = 'consulta'"
                        :class="tab === 'consulta'
                            ? 'pb-3 border-b-2 border-indigo-500 text-indigo-600 font-semibold'
                            : 'pb-3 text-gray-500'"
                    >

                        Consulta

                    </button>

                    {{-- TAB RECETA --}}
                    <button
                        type="button"
                        @click="tab = 'receta'"
                        :class="tab === 'receta'
                            ? 'pb-3 border-b-2 border-indigo-500 text-indigo-600 font-semibold'
                            : 'pb-3 text-gray-500'"
                    >

                        Receta

                    </button>

                </div>

            </div>

            {{-- INPUTS OCULTOS --}}
            <input
                type="hidden"
                name="patient_id"
                value="{{ $appointment->patient_id }}">

            <input
                type="hidden"
                name="doctor_id"
                value="{{ $appointment->doctor_id }}">

            <input
                type="hidden"
                name="appointment_date"
                value="{{ $appointment->appointment_date }}">

            <input
                type="hidden"
                name="start_time"
                value="{{ $appointment->start_time }}">

            <input
                type="hidden"
                name="end_time"
                value="{{ $appointment->end_time }}">

            {{-- ========================= --}}
            {{-- TAB CONSULTA --}}
            {{-- ========================= --}}
            <div
                x-show="tab === 'consulta'"
                x-transition>

                {{-- DIAGNOSTICO --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Diagnóstico

                    </label>

                    <x-wire-textarea
                        name="diagnosis"
                        rows="5"
                        placeholder="Describa el diagnóstico del paciente aquí...">

                        {{ old('diagnosis', $appointment->diagnosis) }}

                    </x-wire-textarea>

                </div>

                {{-- TRATAMIENTO --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Tratamiento

                    </label>

                    <x-wire-textarea
                        name="treatment"
                        rows="5"
                        placeholder="Describa el tratamiento recomendado aquí...">

                        {{ old('treatment', $appointment->treatment) }}

                    </x-wire-textarea>

                </div>

                {{-- NOTAS --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Notas

                    </label>

                    <x-wire-textarea
                        name="notes"
                        rows="4"
                        placeholder="Agregue notas adicionales sobre la consulta...">

                        {{ old('notes', $appointment->notes) }}

                    </x-wire-textarea>

                </div>

                {{-- SINTOMAS --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Síntomas

                    </label>

                    <x-wire-textarea
                        name="symptoms"
                        rows="4"
                        placeholder="Describa los síntomas del paciente...">

                        {{ old('symptoms', $appointment->symptoms) }}

                    </x-wire-textarea>

                </div>

                {{-- MOTIVO --}}
                <div class="mb-6">

                    <label class="block text-sm font-semibold text-gray-700 mb-2">

                        Motivo de consulta

                    </label>

                    <x-wire-textarea
                        name="reason"
                        rows="4"
                        placeholder="Motivo de la consulta...">

                        {{ old('reason', $appointment->reason) }}

                    </x-wire-textarea>

                </div>

                {{-- ESTADO --}}
                <div class="mb-6">

                    <x-wire-native-select
                        label="Estado"
                        name="status">

                        <option
                            value="Pendiente"
                            @selected(old('status', $appointment->status) == 'Pendiente')>

                            Pendiente

                        </option>

                        <option
                            value="En proceso"
                            @selected(old('status', $appointment->status) == 'En proceso')>

                            En proceso

                        </option>

                        <option
                            value="Finalizada"
                            @selected(old('status', $appointment->status) == 'Finalizada')>

                            Finalizada

                        </option>

                    </x-wire-native-select>

                </div>

            </div>

            {{-- ========================= --}}
            {{-- TAB RECETA --}}
            {{-- ========================= --}}
            <div
                x-show="tab === 'receta'"
                x-transition>

                <div class="space-y-4">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- MEDICAMENTO --}}
                        <x-wire-input
                            label="Medicamento"
                            name="medicine"
                            placeholder="Ej: Amoxicilina 500mg"
                            value="{{ old('medicine', $appointment->medicine) }}"
                        />

                        {{-- DOSIS --}}
                        <x-wire-input
                            label="Dosis"
                            name="dose"
                            placeholder="Ej: 1 cada 8 horas"
                            value="{{ old('dose', $appointment->dose) }}"
                        />

                        {{-- FRECUENCIA --}}
                        <x-wire-input
                            label="Frecuencia / Duración"
                            name="frequency"
                            placeholder="Ej: Cada 8 horas por 7 días"
                            value="{{ old('frequency', $appointment->frequency) }}"
                        />

                    </div>

                    {{-- BOTON AÑADIR --}}
                    <div>

                        <x-wire-button
                            gray
                            outline
                            type="button">

                            + Añadir medicamento

                        </x-wire-button>

                    </div>

                </div>

            </div>

        </div>

        {{-- BOTON GUARDAR --}}
        <div class="flex justify-end mt-8">

            <x-wire-button
                type="submit"
                blue>

                Guardar consulta

            </x-wire-button>

        </div>

    </x-wire-card>

</form>

</x-admin-layout>