<?php



use Carbon\Carbon;
use \Illuminate\Support\Facades\Storage;



/**

 * Write code on Method

 *

 * @return response()

 */

if (!function_exists('saveLogs')) {

    function saveLogs($type, $title, $data)
    {
        $fileName = date('Y-m-d') . 'activity' . '.json';
        $fileExist = Storage::disk('local')->exists($fileName);
        if ($fileExist) {
            $logData = Storage::get($fileName);
            $log_array_data = json_decode($logData);
        } else {
            $log_array_data = [];
        }

        $log_array_data[] = [
            'date' => date('Y-m-d H:i:s'),
            'type' => $type,
            'title' => $title,
            'data' => $data
        ];

        $json_log_data = json_encode($log_array_data);
        Storage::put($fileName, $json_log_data);
    }
}
