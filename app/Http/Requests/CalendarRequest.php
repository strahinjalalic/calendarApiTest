<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Captcha;

class CalendarRequest extends FormRequest
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
        return [
            'name' => 'required|min:2|max:25',
            'email' => 'required',
            'phone' => 'required|min:11',
            'time' => 'required',
            'time_finish' => 'required',
            'date' => 'required',
            'g-recaptcha-response' => new Captcha()
        ];
    }
}
