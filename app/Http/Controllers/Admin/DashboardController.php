<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashborad');
    }

    public function change_mode()
    {
        if (Config::get('modetheme.mode') == "dark-skin")
            $mode = "light-skin";
        else    $mode = "dark-skin";
        try {
            $modetheme = fopen(config_path() . '\modetheme.php', "w");
            fwrite($modetheme, "<?php return ['mode' => '$mode' ];");
            // dd($modetheme);
            return response()->json($modetheme);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }
}
