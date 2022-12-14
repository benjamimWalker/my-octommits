<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function test_home_is_redirected_when_user_is_not_authenticated()
    {
        $response = $this->get('/');

        $response->assertRedirectToRoute('login');
    }

    public function test_home_is_not_redirected_when_user_is_authenticated()
    {
        $this->actingAs($this->user);

        $response = $this->get('/');

        $response->assertOk();
    }

    public function test_user_can_log_out()
    {
        $this->actingAs($this->user);

        $response = $this->get('/logout');

        $response->assertRedirect('signin');
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
}
