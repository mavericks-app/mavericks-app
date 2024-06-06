<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->generateRandomPhoneNumber(),
            'phone2' => $this->generateRandomPhoneNumber(),
            'photo' => $this->faker->imageUrl(),
            'address' => $this->faker->address,
            'user_id' => User::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Generate a random phone number with either Spanish or Portuguese country code.
     *
     * @return string
     */
    private function generateRandomPhoneNumber()
    {
        $countryCode = $this->faker->randomElement(['ES', 'PT']);
        switch ($countryCode) {
            case 'ES':
                return '+34' . $this->faker->numerify('6########');
            case 'PT':
                return '+351' . $this->faker->numerify('9########');
            default:
                return $this->faker->phoneNumber;
        }
    }
}
