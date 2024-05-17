<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\CreatePatientRequest;
use App\Http\Requests\Patient\UpdatePatientRequest;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PatientController extends Controller
{

    public function __construct(
        private readonly PatientService $patientService
    ){}

    public function createPatient( CreatePatientRequest $request ) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $newPatient = $this->patientService->createPatient( $data );
            DB::commit();
            return response()->json( new PatientResource( $newPatient ) );
        } catch( ValidationException $ve ){
            DB::rollBack();
            throw $ve;
        } catch( \Exception $e ) {
            DB::rollBack();
            Log::info( $e->getMessage() );
            return response()->json([
                'message' => $e->getMessage()
            ], 400 );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info( $th->getMessage() );
            return response()->json([
                'message' => 'Hubo un error al crear el paciente.'
            ], 500 );
        }
    }

    public function updatePatient( UpdatePatientRequest $request, Patient $patient) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $newPatient = $this->patientService->updatePatient( $patient, $data );
            DB::commit();
            return response()->json( new PatientResource( $newPatient ) );
        } catch( ValidationException $ve ){
            DB::rollBack();
            throw $ve;
        } catch( \Exception $e ) {
            DB::rollBack();
            Log::info( $e->getMessage() );
            return response()->json([
                'message' => $e->getMessage()
            ], 400 );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::info( $th->getMessage() );
            return response()->json([
                'message' => 'Hubo un error al guardar la información del paciente.'
            ], 500 );
        }
    }

    public function findAll() {
        $patients = $this->patientService->findAll();
        return response()->json( new PatientCollection( $patients ) );
    }

    public function findOneById( Patient $patient ) {
        return response()->json( new PatientResource( $patient ));
    }

}
