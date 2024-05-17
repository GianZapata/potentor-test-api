<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PatientService {
    public function __construct() {}

    public function findAll(): Collection {
        $patients = Patient::all();
        return $patients;
    }

    public function findOneById( int $id ): Patient {
        $patient = Patient::findOrFail( $id );
        return $patient;
    }

    public function createPatient( array $patientData ): Patient {
        $records = $patientData['records'] ?? [];
        $newPatient = Patient::create([
            'name'              => $patientData['name'],
            'second_name'       => $patientData['secondName'],
            'last_name'         => $patientData['lastName'],
            'second_last_name'  => $patientData['secondLastName'],
            'age'               => $patientData['age'],
            'type'              => $patientData['type'],
        ]);
        $this->createPatientRecords( $newPatient, $records );
        return $newPatient;
    }

    public function updatePatient( Patient $patient, array $patientData ): Patient {
        $records = $patientData['records'];
        $patient->update([
            'name'              => $patientData['name'] ?? $patient->name,
            'second_name'       => $patientData['secondName'] ?? $patient->second_name,
            'last_name'         => $patientData['lastName'] ?? $patient->last_name,
            'second_last_name'  => $patientData['secondLastName'] ?? $patient->second_last_name,
            'age'               => $patientData['age'] ?? $patient->age,
            'type'              => $patientData['type'] ?? $patient->type,
        ]);
        $this->updatePatientRecords( $patient, $records );
        $patient->save();
        return $patient;
    }

    private function updatePatientRecords( Patient $patient, array $records ): void {
        if( empty( $records ) ) return;
        foreach( $records as $record ) {
            $this->updatePatientRecord( $patient, $record );
        }
    }

    private function createPatientRecords( Patient $patient, array $records ): void {
        if( empty( $records ) ) return;
        foreach( $records as $record ) {
            $this->createPatientRecord( $patient, $record );
        }
    }

    private function createPatientRecord( Patient $patient, array $recordData ): PatientRecord {
        $newRecord = $patient->records()->create([
            'patient_id'    => $patient->id,
            'name'          => $recordData['name'],
            'blood_type'    => $recordData['bloodType'],
            'birth_date'    => $recordData['birthDate'],
            'ph'            => $recordData['ph'] ?? null,
        ]);
        return $newRecord;
    }

    private function updatePatientRecord( Patient $patient, array $recordData ): PatientRecord {
        $record = $patient->records()->find( $recordData['id'] );
        if(!$record) throw new \Exception("El expediente no pertenece al paciente");
        $ph = array_key_exists('ph', $recordData) ? $recordData['ph'] : $record->ph;
        $record->update([
            'name'          => $recordData['name']      ?? $record->name,
            'blood_type'    => $recordData['bloodType'] ?? $record->blood_type,
            'birth_date'    => $recordData['birthDate'] ?? $record->birth_date,
            'ph'            => isset($recordData['ph']) ? (is_null($recordData['ph']) ? null : $recordData['ph']) : $record->ph,
        ]);
        return $record;
    }

}
