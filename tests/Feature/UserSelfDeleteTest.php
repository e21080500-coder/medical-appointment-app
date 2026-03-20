<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;


//Refresca la base de datos entre prueba
uses(RefreshDatabase::class);

test('un usuario no puede eliminarse a si mismo', function () {

    //CREAR UN USUARIO EN LA BD DE PRUBAS
    $user = User::factory()->create(
        [
        'email_verified_at' => now(),
        ]
    );


    //SIMULAR QUE EL USUARIO ESTA INICIANDO SESION
    $this->actingAs($user, 'web');

    //SIMULAR QUE INTENTA BORRAR UN USUARIO
    $response = $this->delete(route('admin.users.destroy', $user));
    
    //ESPERAR A QUE EL SERVIDOR BLOQUEE ESTA ACCION
    //$response->assertStatus(403);

    //VERIFICAMOS QUE EL USUARIO SIGUE EXISTIENDO EN LA BASE DE DATOS
    $this->assertDatabaseHas('users', [
        'id' => $user->id,
    ]);

});
