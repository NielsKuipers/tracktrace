<?php


use Tests\TestCase;

class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $response = $this->post('/login');
        $response->assertRedirect('/');
    }
}
