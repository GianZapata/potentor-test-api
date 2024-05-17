<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientRequest extends FormRequest
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
            'name'                      => ['string', 'required'],
            'secondName'                => ['string', 'required'],
            'lastName'                  => ['string', 'required'],
            'secondLastName'            => ['string', 'required'],
            'age'                       => ['integer', 'required', 'min:0'],
            'type'                      => ['required', 'string', 'in:analysis,pregnant-test,biometric'],
            'records'                   => ['required', 'array'],
            'records.*.name'            => ['string', 'required'],
            'records.*.bloodType'       => ['string', 'required','min:1','max:2'],
            'records.*.birthDate'       => ['string', 'required','date_format:Y-m-d'],
            'records.*.ph'              => ['sometimes','string', 'min:1', 'max:5']
        ];
    }
}
