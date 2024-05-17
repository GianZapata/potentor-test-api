<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'birthDate'    => $this->birth_date,
            'bloodType'    => $this->blood_type,
            'name'          => $this->name,
            'patientId'    => $this->patient_id,
            'ph'            => $this->ph,
        ];
    }
}
