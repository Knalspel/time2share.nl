<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update product status from loaning to return when the deadline has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        $products = Product::where('status', 'LOANING')->whereDate('deadline', '<=', $today)->update(['status' => 'RETURN']);
    }
}
