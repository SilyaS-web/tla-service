<?php

namespace API;

use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * A basic feature test example.
     */
    public function test_seller_can_be_stored(): void
    {
        $tg_data = [
            'username' => $this->faker->userName,
            'chat_id' => $this->faker->numberBetween(1000, 99999),
            'phone' => '+79998880100',
        ];

        $response = $this->postJson('/api/phones', $tg_data);

        $response->assertStatus(200);

        $user_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'role' => 'seller',
            'password' => $this->faker->password(9),
            'phone' => '+79998880100',
        ];

        $response = $this->postJson('/api/users', $user_data);
        $response->assertStatus(200);
    }
}
