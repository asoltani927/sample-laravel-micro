<?php

namespace Tests\Feature;

use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BalanceAmountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $model = Balance::inRandomOrder()
            ->limit(3)
            ->get()->toArray();
        $correct = 0;
        foreach ($model as $balance) {
            $sum = Transaction::where('user_id', '=', $balance['user_id'])->sum('amount');
            if ((int)$balance['amount'] === (int)$sum) {
                $correct++;
            }
        }
        $this->assertEquals(count($model), $correct, 'total of transaction is not equal with the user balance');
    }
}
