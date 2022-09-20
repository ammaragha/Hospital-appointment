<?php

namespace App\Http\Requests\Reservation;

use App\Http\Controllers\Api\SettingController;
use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $setting  = new SettingController;
        $response = $setting->getWorkTime();
        $worktime = json_decode($response->getContent())->data;

        return [
            'time'=> ['required','date_format:H:i',"after:{$worktime->start_time}","before:{$worktime->end_time}"],
            'date'=> ['required','date_format:Y-m-d','after:yesterday'],
            'special_id'=> ['required','exists:specialities,id'],
        ];
    }


    public function messages()
    {
        return [
            'date.after'=> "date must be valid date start from today",
        ];
    }
}
