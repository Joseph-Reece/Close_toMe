<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class PatientTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /* public function testCreatePatientWithMiddleware()
    {
        $data = [
            'fname' => "Denis ",
            'lname' => " Okari",
            'personal_id' => 2459745,
            'email' => "den@mail.com",
            'contact' => 754210,
            'address' => "Nairobi",
            'gender' => "Male",
            'dob' => "2020-07-02",
        ];

        $response = $this->json('POST', '/client/patients', $data);
        $response->assertStatus(401);
        $response->assertJson(['message' => "Unauthenticated."]);
    }
 */
   /*  public function testCreatePatient()
    {

        $user = factory(patient::class)->make();
        $response = $this->json('POST', '/patients/create', $user);
        $response->assertStatus(200);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => "patient Created!"]);
        $response->assertJson(['data' => $user]);
    } */

    // public function testGettingAllPatients()
    // {
    //     $response = $this->json('GET', '/api/patients');
    //     $response->assertStatus(200);

    //     $response->assertJsonStructure(
    //         [
    //             [
    //                 'id',
    //                 'fname',
    //                 'lname',k
    //                 'personal_id',
    //                 'email' ,
    //                 'contact',
    //                 'address',
    //                 'gender',
    //                 'dob',
    //                 'created_at',
    //                 'updated_at'
    //             ]
    //         ]
    //     );
    // }
}
