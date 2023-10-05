<?php

namespace Tests\Unit\Repository;

use DTApi\Models\User;
use DTApi\Repository\UserRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase; // useful for resetting the DB after tests

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository(new User());
    }

    /** @test */
    public function it_creates_a_new_user()
    {
        $requestData = [
            'name' => 'Test User',
            'email' => 'test@example.com'
        ];

        $user = $this->userRepository->createOrUpdate(null, $requestData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($requestData['name'], $user->name);
        $this->assertEquals($requestData['email'], $user->email);
    }

    /** @test */
    public function it_updates_existing_user()
    {
        $originalUser = User::factory()->create(); // assuming you have a user factory

        $updateData = [
            'name' => 'Updated User',
            'email' => 'updated@example.com',
        ];

        $user = $this->userRepository->createOrUpdate($originalUser->id, $updateData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($updateData['name'], $user->name);
        $this->assertEquals($updateData['email'], $user->email);
    }

}
