<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->json('POST', '/api/register', [
            'name'  =>  $name = 'Test',
            'email'  =>  time().'test@gmail.com',
            'password'  =>  '123456789',
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    public function testLogin()
    {
        $email = time().'_test@gmail.com';
        $password = '123456789';

        // Creating Users
        $user = User::create([
            'name' => 'Test',
            'email'=> $email,
            'password' => Hash::make($password)
        ]);

        // Simulated landing
        $response = $this->json('POST','api/login',[
            'email' => $email,
            'password' => $password,
        ]);

        // Determine whether the login is successful and receive token 
        $response->assertStatus(200);
        $this->assertArrayHasKey('token',$response->json());
    }
}
