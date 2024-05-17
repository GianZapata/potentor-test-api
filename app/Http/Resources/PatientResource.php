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
            'lastName'          => $this->last_name,
            'name'              => $this->name,
            'secondLastName'    => $this->second_last_name,
            'secondName'        => $this->second_name,
            'fullName'          => $this->full_name,
            'type'              => $this->type,
            'humanizedType'     => $this->humanizedType(),
            'records'           => new PatientRecordCollection( $this->records )
        ];
    }

    private function humanizedType(): string {
        switch( $this->type ) {
            case "analysis":
                return "Análisis";
            case "pregnant-test":
                return "Prueba de embarazo";
            case "biometric":
                return "Biometría";
            default:
                return "Desconocido";
        }
    }

}
