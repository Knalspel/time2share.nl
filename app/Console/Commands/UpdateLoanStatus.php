<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class UpdateLoanStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the loans status of products from LOANING to RETURN when the deadline arrives';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::where('status', 'LOANING')->where('deadline', '<=', Carbon::today())->get();

        foreach ($products as $product) {
            $product->update(['status' => 'RETURN']);
        }
    }
}
