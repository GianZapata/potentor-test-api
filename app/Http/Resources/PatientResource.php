<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'age'               => $this->age,
            'last_name'         => $this->last_name,
            'name'              => $this->name,
            'second_last_name'  => $this->second_last_name,
            'second_name'       => $this->second_name,
            'type'              => $this->type,
            'records'           => new PatientRecordCollection( $this->records )
        ];
    }
}
