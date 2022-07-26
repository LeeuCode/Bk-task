<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Student;
use App\Models\School;
use App\Models\User;
use Tests\TestCase;


class StudentTest extends TestCase
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

    protected function createUser($school_id)
    {
        $studentByStudent = Student::where('school_id', $school_id);

        if ($studentByStudent->count() > 0) {
            $lastID = $studentByStudent->orderby('order', 'desc')->first();
            $order = ($lastID->order +1);
        } else {
            $order = 1;
        }

        return $order;
    }

    /**
     * test create student.
     *
     * @return void
     */
    public function test_create_student()
    {
        $token = $this->authenticate();

        $school = School::inRandomOrder()->first();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/student/store', [
            'name' => 'Student test create',
            'school_id' => $school->id,
            'order' => $this->createUser($school->id)
        ]);

        $response->assertStatus(200);
    }

    public function test_update_student()
    {
        $token = $this->authenticate();

        $school = School::inRandomOrder()->first();

        $student = Student::create([
            'name' => 'Student test updated',
            'school_id' => $school->id,
            'order' => $this->createUser($school->id)
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/student/update/'. $student->id, [
            'name' => 'Test student update',
            'school_id' => $school->id
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_student()
    {
        $token = $this->authenticate();

        $school = School::inRandomOrder()->first();

        $student = Student::create([
            'name' => 'Student test deleted',
            'school_id' => $school->id,
            'order' => $this->createUser($school->id)
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('DELETE', 'api/student/delete/'.$student->id);

        $response->assertStatus(200);
    }

    public function test_restore_student()
    {
        $token = $this->authenticate();

        $school = School::inRandomOrder()->first();

        $student = Student::create([
            'name' => 'Student test restore',
            'school_id' => $school->id,
            'order' => $this->createUser($school->id)
        ]);

        $student->delete();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/student/restore/'.$student->id);

        $response->assertStatus(200);
    }

    public function test_forceDelete_student()
    {
        $token = $this->authenticate();

        $school = School::inRandomOrder()->first();

        $student = Student::create([
            'name' => 'Student test force delete',
            'school_id' => $school->id,
            'order' => $this->createUser($school->id)
        ]);

        $student->delete();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/student/force/delete/'.$student->id);

        $response->assertStatus(200);
    }
}
