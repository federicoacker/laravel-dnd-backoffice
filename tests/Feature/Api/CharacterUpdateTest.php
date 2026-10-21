<?php

namespace Tests\Feature\Api;

use App\Models\Character;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacterUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_update_their_character_without_changing_ownership(): void
    {
        $owner = $this->createUser();
        $character = $this->createCharacter($owner);

        $this->actingAs($owner, 'sanctum')
            ->patchJson("/api/characters/{$character->id}", [
                'name' => 'Updated name',
                'user_id' => 9999,
            ])
            ->assertOk()
            ->assertJsonPath('data.name', 'Updated name');

        $this->assertSame($owner->id, $character->fresh()->user_id);
    }

    public function test_user_cannot_update_another_users_character(): void
    {
        $owner = $this->createUser();
        $otherUser = $this->createUser();
        $character = $this->createCharacter($owner);

        $this->actingAs($otherUser, 'sanctum')
            ->patchJson("/api/characters/{$character->id}", ['name' => 'Not allowed'])
            ->assertForbidden();

        $this->assertSame('Test character', $character->fresh()->name);
    }

    public function test_admin_can_update_any_users_character(): void
    {
        $owner = $this->createUser();
        $admin = $this->createUser('admin');
        $character = $this->createCharacter($owner);

        $this->actingAs($admin, 'sanctum')
            ->patchJson("/api/characters/{$character->id}", ['name' => 'Admin edit'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Admin edit');

        $this->assertSame($owner->id, $character->fresh()->user_id);
    }

    private function createCharacter(User $owner): Character
    {
        $character = new Character();
        $character->user_id = $owner->id;
        $character->name = 'Test character';
        $character->inventory = '';
        $character->save();

        return $character;
    }

    private function createUser(string $role = 'user'): User
    {
        $user = User::factory()->create();
        $user->role = $role;
        $user->save();

        return $user;
    }
}
