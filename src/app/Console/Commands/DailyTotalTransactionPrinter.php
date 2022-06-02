<?php

namespace App\Console\Commands;

use App\Models\Balance;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DailyTotalTransactionPrinter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:totally';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $yesterday_first = Carbon::yesterday()->setHour(0)->setMinute(0)->setSecond(0)->setMillisecond(0);
        $yesterday_end = Carbon::yesterday()->setHour(23)->setMinute(59)->setSecond(59)->setMillisecond(999);
        $sum = Balance::whereBetween('created_at', [$yesterday_first, $yesterday_end])->sum('amount');
        dd([
            $yesterday_first->format('Y-m-d H:i'),
            $yesterday_end->format('Y-m-d H:i'),
            $sum
        ]);
    }
}
