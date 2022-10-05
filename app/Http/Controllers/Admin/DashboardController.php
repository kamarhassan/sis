<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function __construct()
    {
      
     }

    public function index()
    {
        return view('admin.dashboard.dashborad');
    }

    public function change_mode()
    {
        try {

            if (Session::has('mode')) {

                if (Session::get('mode') == "dark")
                    $mode = "light";
                else    $mode = "dark";
                Session::flash('mode');
                Session::put('mode', $mode);
            }


            // Session::put('mode',Config::get('modetheme.mode'));
            $mode_theme = Session::get('mode', $mode);
            //    dd(Session::get('mode'));
            // $modetheme = fopen(config_path() . '\modetheme.php', "w");
            // fwrite($modetheme, "<?php return ['mode' => '$mode' ];");
            // dd($modetheme);
            return response()->json($mode_theme);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }
}
