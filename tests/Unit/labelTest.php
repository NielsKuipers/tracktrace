<?php


use App\Models\Package;
use Tests\TestCase;

class labelTest extends TestCase
{
    public function test_creating_labels()
    {
        $package = Package::factory()->create();

        $this->post('/login', [
            'email' => 'frankAdmin@hotmail.com',
            'password' => 'mama123'
        ]);

        $toPrint = [$package->id];

        $response = $this->post('/packages/labels/print', [
            'toPrint' => $toPrint
        ]);

        $response->assertRedirect('/packages/labels/print');
        $response->assertSessionHas('success');
    }
}
