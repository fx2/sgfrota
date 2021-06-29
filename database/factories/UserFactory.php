<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
//ssh -4 pei@ftp.pei.kinghost.net 
// Senha git ssh frotas IIzamFh$t;^Y

// github:
// key-sgfrotas

// https://www.youtube.com/watch?v=3-6wQIDj-yE

// ssh -p 10428 sgfrota@138.128.185.185

//bd  -> sgfrota_faria 372KO0LTJ(Ap

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
