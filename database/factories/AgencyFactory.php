<?php

namespace Database\Factories;

use App\Enums\AgencyRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agency>
 */
class AgencyFactory extends Factory
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
            'agencyRole' => AgencyRole::Fake,
            'email' => $this->faker->unique()->companyEmail,
            'phone' => $this->generateRandomPhoneNumber(),
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'website'>= $this->faker->domainName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

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
