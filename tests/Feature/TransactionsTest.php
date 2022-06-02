<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws Exception
     */
    public function test_example()
    {
        $response = $this->post('/api/transactions', [
            'user_id' => 55,
            'amount' => random_int(1000, 100000)
        ]);

        $response->assertStatus(200);
    }
}
