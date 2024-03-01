<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from users");
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        self::assertTrue($this->userService->login("samuel@localhost", "rahasia"));
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
