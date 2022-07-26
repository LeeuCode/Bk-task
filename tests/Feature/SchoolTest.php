<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class SchoolTest extends TestCase
{

    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345, 678910) . 'test@gmail.com',
            'password' => \Hash::make('secret9874'),
        ]);

        if (!auth()->attempt(['email' => $user->email, 'password' => 'secret1234'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        return $accessToken = auth()->user()->createToken('authToken')->accessToken;
    }

    /**
     * test create school.
     *
     * @return void
     */
    public function test_create_school()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', route('api.school.store'), [
            'name' => 'Test school',
        ]);

        //Write the response in laravel.log
        // \Log::info(1, [$response->getContent()]);
        // dd($response);
        $response->assertStatus(201);
    }
}
