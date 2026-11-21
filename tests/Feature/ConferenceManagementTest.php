<?php

namespace Tests\Feature;

use App\Models\Conference;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConferenceManagementTest extends TestCase
{
    use RefreshDatabase;

    private function conferenceData(): array
    {
        return [
            'title' => 'Example conference',
            'description' => 'A conference about practical software development.',
            'date' => '2027-04-15',
            'address' => 'Main Street 10',
            'city' => 'Vilnius',
            'capacity' => 80,
        ];
    }

    public function test_guest_can_view_conferences_but_cannot_change_them(): void
    {
        $conference = Conference::create($this->conferenceData());

        $this->get('/')->assertOk()->assertSee('Example conference');
        $this->get(route('conferences.show', $conference))->assertOk()->assertSee('Example conference');
        $this->get(route('conferences.create'))->assertRedirect(route('login'));
        $this->get(route('conferences.edit', $conference))->assertRedirect(route('login'));
        $this->post(route('conferences.store'), $this->conferenceData())->assertRedirect(route('login'));
        $this->put(route('conferences.update', $conference), $this->conferenceData())->assertRedirect(route('login'));
        $this->delete(route('conferences.destroy', $conference))->assertRedirect(route('login'));
        $this->assertDatabaseCount('conferences', 1);
    }

    public function test_administrator_can_create_update_and_delete_conferences(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('conferences.store'), $this->conferenceData())->assertRedirect(route('conferences.index'));
        $conference = Conference::firstOrFail();
        $this->get(route('conferences.edit', $conference))->assertOk()->assertSee('Example conference');

        $updated = array_merge($this->conferenceData(), ['title' => 'Updated conference']);
        $this->put(route('conferences.update', $conference), $updated)->assertRedirect(route('conferences.index'));
        $this->assertDatabaseHas('conferences', ['id' => $conference->id, 'title' => 'Updated conference']);

        $this->delete(route('conferences.destroy', $conference))->assertRedirect(route('conferences.index'));
        $this->assertDatabaseCount('conferences', 0);
    }

    public function test_required_fields_are_validated_on_server(): void
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('conferences.store'), [])->assertSessionHasErrors([
            'title', 'description', 'date', 'address', 'city', 'capacity',
        ]);
        $this->assertDatabaseCount('conferences', 0);
    }

    public function test_login_and_logout_work(): void
    {
        $user = User::factory()->create(['password' => 'secret-password']);

        $this->post(route('login.attempt'), ['email' => $user->email, 'password' => 'wrong'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->post(route('login.attempt'), ['email' => $user->email, 'password' => 'secret-password'])
            ->assertRedirect(route('conferences.index'));
        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))->assertRedirect(route('conferences.index'));
        $this->assertGuest();
    }
}
