<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\School;

class SchoolTest extends TestCase
{

    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345, 678910) . 'test@gmail.com',
            'password' => \Hash::make('secret9874'),
        ]);

        if (!auth()->attempt(['email' => $user->email, 'password' => 'secret9874'])) {
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
        ])->json('POST', 'api/school/store', [
            'name' => 'Test school',
        ]);

        //Write the response in laravel.log
        // \Log::info(1, [$response->getContent()]);
        // dd($response);
        $response->assertStatus(200);
    }

    public function test_update_school()
    {
        $token = $this->authenticate();

        $school = School::create([
            'name' => 'School test create'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/school/update/'. $school->id, [
            'name' => 'Test school update',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_school()
    {
        $token = $this->authenticate();

        $school = School::create([
            'name' => 'School test for deleted'
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/school/delete/'.$school->id);

        $response->assertStatus(200);
    }

    public function test_restore_school()
    {
        $token = $this->authenticate();

        $school = School::create([
            'name' => 'School test for restore'
        ]);

        $school->delete();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/school/restore/'.$school->id);

        $response->assertStatus(200);
    }

    public function test_forceDelete_school()
    {
        $token = $this->authenticate();

        $school = School::create([
            'name' => 'School test for force delete'
        ]);

        $school->delete();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/school/force/delete/'.$school->id);

        $response->assertStatus(200);
    }
}
