<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreTrip extends FormRequest
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
            // db columns
            'name' => 'required|string|max:255',
            'city_id' =>'required|int|gt:0',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after:date_from',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please choose a trip destination',
            'date_from.required' => 'Please choose a departing date',
            'date_to.required' => 'Please choose an arrival date',
            'date_to.after' => 'Arrival date must be after departure date'
        ];
    }
}
