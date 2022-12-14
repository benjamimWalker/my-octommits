<?php

namespace Tests\Feature;

use App\Models\History;
use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function test_login_screen_is_working()
    {
        $this->get('/signin')
            ->assertStatus(200)
            ->assertSeeTextInOrder(['My Octommits', 'Sign in with your GitHub account']);
    }

    public function test_home_shows_user_repositories()
    {
        $this->actingAs($this->user);

        $this->get('/')
            ->assertSee(array_values($this->user->repositories()->select('name')->pluck('name')->toArray()));
    }

    public function test_user_component_is_rendered_correctly()
    {
        $this->blade('<x-user :user="$user"/>', [
            'user' => $this->user
        ])->assertSeeTextInOrder([
            $this->user->name,
            $this->user->nickname,
            'Logout'
        ]);
    }

    public function test_repositories_component_is_rendered_correctly()
    {
        $this->blade('<x-repos :repos="$repos"/>', [
            'repos' => $this->user->repositories()->paginate()
        ])->assertSeeText($this->user->repositories()->first()->name);
    }

    public function test_history_screen_is_working()
    {
        $repo = Repository::first();

        History::factory(10)->create([
            'repository_id' => $repo->id
        ]);

        $this->actingAs($this->user);

        $this->get("/$repo->id/history")
            ->assertSeeText($repo->name);

        // Unfortunately, I still can't test the chart because it is an html canvas
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Repository::factory(10)->create([
            'user_id' => $this->user->id
        ]);
    }
}
