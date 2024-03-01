<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("samuel", "rahasia"));
    }

    public function testLoginUserNotFound()
    {
        assertFalse($this->userService->login("eko", "rahasia"));
    }

    public function testLoginWrongPassword()
    {
        assertFalse($this->userService->login("samuel", "salah"));
    }
}
