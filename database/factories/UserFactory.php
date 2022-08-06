<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
@ -17,27 +19,36 @@
     */
    public function definition()
    {
        $role = Role::customer()->first();
        return [
            'role_id' => $role->id,
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'surname' => fake()->lastName,
            'birthdate' => fake()->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->e164PhoneNumber,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('test1234'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
                'role_id'=>Role::admin()->first()->id,
            ];
        });
    }

    public function withEmail(string $email)
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email,
            ];
        });
    }
}

