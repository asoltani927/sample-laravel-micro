<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;

class BalancesController extends Controller
{
    //
    // here we can make a request validation class
    // but I continue it with a quick way
    //
    public function getBalance(Request $req)
    {
        $model = null;
        if ($req->filled('user_id')) {
            $model = Balance::where('user_id', '=', $req->user_id)->first();
        }
        return $model ? ['balance' => $model->amount] : ['balance' => 0];
    }
}
