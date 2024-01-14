<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class ArtisanCommandController extends Controller
{
   public function command($index)
   {
      try {
         switch ($index) {
            case 'db-seed':
               $command_run_status = Artisan::call('db:seed');
               break;
            case 'clc':
               $command_run_status = Artisan::call('cache:clear');
               $command_run_status = Artisan::call('optimize:clear');
               break;

            case 'migrate':
               $command_run_status = Artisan::call('migarte');
               break;
            case 'storage-link':
               Artisan::call('config:clear');
               $command_run_status = Artisan::call('storage:link');
               break;
            case 'edm':
               $this->enable_disable_debug_mode('true');
               Artisan::call('config:clear');
               break;
            case 'ddm':

               $this->enable_disable_debug_mode('false');
               Artisan::call('config:clear');


               break;

            default:

               break;
         }
         return back();
      } catch (\Throwable $th) {
         throw $th;
      }
   }



   private function enable_disable_debug_mode($status_true_false)
   {

      $path = base_path('.env');


      if (file_exists($path)) {
         file_put_contents($path, str_replace(
            'APP_DEBUG=' . getenv('APP_DEBUG'),
            'APP_DEBUG=' . $status_true_false,
            file_get_contents($path)
         ));
      }
   }
}
