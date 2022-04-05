<?php
use Tests\TestCase;

class trackingTest extends TestCase
{
    public function test_tracking_linked_to_user()
    {
        $response = $this->get('tracked/package/1');
        $response->assertForbidden();
    }
}
