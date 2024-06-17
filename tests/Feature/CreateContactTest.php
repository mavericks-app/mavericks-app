<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Carbon\Carbon;

class CreateContactTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_new_contact_can_be_created(): void
    {

        $user = User::factory()->create();

        Sanctum::actingAs($user);

        /** @var \App\Models\User $authenticatedUser */
        $authenticatedUser = auth()->user();

        // Ahora PhpStorm sabe que $authenticatedUser es una instancia de User
        $this->assertEquals($user->id, $authenticatedUser->id, 'El usuario autenticado no es el esperado');

        // Arrange
        $contactData = [
            "name" => "Perico",
            "last_name" => "Delgado",
            "birth_date" => "2002-01-08",
            "email" => "pericazo@gmail.com",
            'phone' => '+34 654321978', // Este valor será mutado
            'phone2' => '+35 101 233 213', // Este valor será mutado
            "photo" => "https://mifotos/com/fotito.jpg",
            "address" => "Calle Benito Camelas",
            "user_id" => $user->id,
        ];


        $expectedData = [
            'name' => 'Perico',
            'last_name' => 'Delgado',
            'birth_date' => '2002-01-08',
            'email' => 'pericazo@gmail.com',
            'phone' => '+34654321978', // Valor esperado sin espacios
            'phone2' => '+35101233213', // Valor esperado sin espacios
            'photo' => 'https://mifotos/com/fotito.jpg',
            'address' => 'Calle Benito Camelas',
            'user_id' => $user->id,
        ];

        // Act
        $response = $this->postJson('/api/v1/contacts', $contactData);

        // Asserts
        $response->assertJson(['success' => true]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('contacts',$expectedData);

    }
}
