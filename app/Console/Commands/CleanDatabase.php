<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CleanDatabase extends Command
{
    protected $signature = 'db:clean';
    protected $description = 'Clean all test data from database';

    public function handle()
    {
        if (!$this->confirm('Are you sure you want to clean all data? This cannot be undone!')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Cleaning database...');

        // Delete orders & related
        OrderItem::truncate();
        Order::truncate();
        $this->info('✓ Orders cleaned');

        // Delete carts
        Cart::truncate();
        $this->info('✓ Carts cleaned');

        // Delete test users (keep admin)
        User::where('email', '!=', 'admin@mouglowing.com')->delete();
        $this->info('✓ Test users cleaned');

        // Reset product stocks (optional)
        // Product::query()->update(['stock' => 0]);

        $this->info('✅ Database cleaned successfully!');
        $this->info('Admin account: admin@mouglowing.com / AdminMouGlowing2024!');
    }
}