<?php

namespace App\Http\Requests\Admin;

use App\Rules\DateBetweenRule;
use App\Rules\TimeBetweenRule;
use Illuminate\Foundation\Http\FormRequest;

class NewReservationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email'],
            'res_date' => ['required', 'date',New DateBetweenRule() , New TimeBetweenRule()],
            'tel_number' => ['required'],
            'table_id' => ['required','exists:tables,id'],
            'guest_number' => ['required', 'integer'],
            'meals' => ['required'],
        ];
    }
}
