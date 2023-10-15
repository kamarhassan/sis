<?php

namespace App\Console\Commands;

use App\Models\Service;
use Illuminate\Console\Command;
use App\Models\NotificationAdmin;
use Illuminate\Support\Facades\DB;

class CheckLowStock extends Command
{
   protected $signature = 'check:low-stock';
   protected $description = 'Check for low stock items and insert notifications';

   public function handle()
   {
      try {

         $items = DB::table('services')
            ->whereNotNull('low_stock_notifiy')
            ->whereNotNull('quantity')
            ->whereColumn('quantity', '<=', 'low_stock_notifiy')
            ->get();


         foreach ($items as $item) {
            $reserveCours = NotificationAdmin::create([
               'user_id' => 0,
               'order_id' => $item->id,
               'order_type' => 'low_stock',
               'description' => __('site.low stock notify')
            ]);
         }
      } catch (\Throwable $th) {
         throw $th;
      }
      $this->info('Low stock check completed.');
   }
}
