<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindAvailableSlotsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer', 'exists:employees,id'],
            'service_id' => ['required', 'integer', 'exists:service,id'],
            'date' => ['required', 'data_format:Y-m-d'],
        ];
    }
}
