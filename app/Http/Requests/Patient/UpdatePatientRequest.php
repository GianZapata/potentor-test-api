<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                      => ['sometimes', 'string'],
            'secondName'                => ['sometimes', 'string'],
            'lastName'                  => ['sometimes', 'string'],
            'secondLastName'            => ['sometimes', 'string'],
            'age'                       => ['sometimes', 'integer', 'min:0'],
            'type'                      => ['sometimes', 'string', 'in:analysis,pregnant-test,biometric'],
            'records'                   => ['sometimes', 'array'],
            'records.*.id'              => ['required', 'integer', 'exists:patient_records,id'],
            'records.*.name'            => ['sometimes', 'string', ],
            'records.*.bloodType'       => ['sometimes', 'string', 'min:1','max:2'],
            'records.*.birthDate'       => ['sometimes', 'string', 'date_format:Y-m-d'],
            'records.*.ph'              => ['string', 'nullable', 'min:1', 'max:5']
        ];
    }
}
