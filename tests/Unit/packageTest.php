<?php


use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class packageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->post('/login', [
            'email' => 'frankCompany@hotmail.com',
            'password' => 'mama123'
        ]);

        $response = $this->post('packages/log', [
            'first_name' => 'mario',
            'last_name' => 'judah',
            'country' => 'The Netherlands',
            'zipcode' => '1234AB',
            'building_number' => 45,
            'street' => 'Gomerstraat',
            'city' => 'Nijmegen',
            'weight' => 3,
        ]);

        $response->assertRedirect('/packages/log');
        $response->assertSessionHas('success');
    }
}
