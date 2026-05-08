<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            // Relación paciente
            $table->foreignId('patient_id')
                ->constrained()
                ->onDelete('cascade');

            // Relación doctor
            $table->foreignId('doctor_id')
                ->constrained()
                ->onDelete('cascade');

            // Información cita
            $table->date('appointment_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->string('status')
                ->default('Pendiente');

            $table->text('reason');

            // Consulta médica
            $table->text('symptoms')->nullable();

            $table->text('diagnosis')->nullable();

            $table->text('treatment')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
