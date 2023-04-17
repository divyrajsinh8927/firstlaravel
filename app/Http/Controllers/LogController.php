<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Storage;

class LogController extends Controller
{
    public function getAllLogs($urlfilename = null)
    {
        if ($urlfilename == null) {
            $fileName = date('Y-m-d') . 'activity' . '.json';
            $fileExist = Storage::disk('local')->exists($fileName);
            if ($fileExist) {

                $log_json_Data = Storage::get($fileName);

                $log_data = json_decode($log_json_Data, true);

                $log_array_data = $log_data;
            } else {
                $log_array_data = [];
            }
            return view('logs', compact('log_array_data'));
        }

        $fileExist = Storage::disk('local')->exists($urlfilename);
        if ($fileExist) {

            $log_json_Data = Storage::get($urlfilename);

            $log_data = json_decode($log_json_Data, true);

            $log_array_data = $log_data;
        } else {
            $log_array_data = [];
        }
        return view('logs', compact('log_array_data'));
    }
}
