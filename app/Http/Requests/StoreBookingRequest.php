<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'resource_id' => 'required|integer|exists:resources,id',
            'user_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ];
    }
}
