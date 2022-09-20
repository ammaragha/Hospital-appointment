<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    use ResponseTrait;

    public function getWorkTime()
    {
        $worktime = Setting::whereIn('slg', ['start_time', 'end_time'])->get()->toArray();
        $start_time = date("H:i", strtotime($this->getWithSlg($worktime, 'start_time')));
        $end_time = date("H:i", strtotime($this->getWithSlg($worktime, 'end_time')));

        return $this->succWithData([
            'start_time' => $start_time, 'end_time' => $end_time
        ], 'Work time start to end');
    }



    //get value from settings with slg name
    private function getWithSlg($arr, $slg)
    {
        foreach ($arr as $row) {
            if ($row['slg'] == $slg)
                return $row['value'];
        }
    }
}
