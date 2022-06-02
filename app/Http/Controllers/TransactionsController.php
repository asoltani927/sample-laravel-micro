<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionsCreateRequest;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    //
    public function store(TransactionsCreateRequest $request)
    {
        // here it's better that the user cross through authorization and validation
        // which lead to prevent from data sabotage
        // this part is depends on our application policy
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'amount' => $request->amount,
            ]);

            $balance = Balance::where('user_id', '=', $request->user_id)->first();
            if ($balance) {
                $balance->amount = $balance->amount + $request->amount;
                $balance->save();
            } else {
                Balance::create([
                    'user_id' => $request->user_id,
                    'amount' => $request->amount,
                ]);
            }
            DB::commit();
            if ($transaction) {
                return ['reference_id' => $transaction->id];
            }
        } catch (\Exception $ex) {
            return response($ex->getMessage(), 500);
        }
        return response('Creating transaction has error', 500);
    }
}
