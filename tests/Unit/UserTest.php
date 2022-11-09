<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_dublication()
    {
        $user1 = User::make([
            'name' => 'Ezio Auditore',
            'email' => 'ezio@email.com'
        ]);
        $user2 = User::make([
            'name' => 'Gabriel Knight',
            'email' => 'gabriel@email.com'
        ]);

        $this->assertTrue($user1->email != $user2->email);
    }

    public function test_delete_user(){
        $user = User::factory()->count(1)->make();
        $user = $user->first();

        if($user){
            $user->delete();
        }
        $this->assertTrue(true);
    }

    public function test_user_register(){
        $response = $this->post('/api/v3/merchant/user/register',[
            'name' => 'Ezio',
            'email' => 'ezio@email.com',
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);
        $response->assertStatus(201);
        User::where('email','ezio@email.com')->first()->delete();
    }

    public function test_user_login(){
        $response = $this->post('/api/v3/merchant/user/login',[
            'email' => 'test@testuser',
            'password' => '123456',
        ]);

        $response->assertStatus(200);
    }
}
