<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_dapat_login_dengan_kredensial_valid()
    {
        $user = User::factory()->create([
            'email' => 'admin@perpus.sch.id',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@perpus.sch.id',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function login_ditolak_jika_kredensial_salah()
    {
        User::factory()->create([
            'email' => 'admin@perpus.sch.id',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@perpus.sch.id',
            'password' => 'password-salah',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}
