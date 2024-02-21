<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_auth(): void
    {
        $this->withoutExceptionHandling(); 
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/profile/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_beginwithb(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/beginwithb');
        $response->assertStatus(200);
    }

    public function test_additem1(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('api/additem/1');
        $response->assertStatus(200);
    }
}
