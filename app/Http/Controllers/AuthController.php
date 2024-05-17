<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function __construct(
        private readonly AuthService $authService
    ){}


    public function login( LoginRequest $request ){

        $loginData = $request->validated();

        $loginResponse = $this->authService->login( $loginData );

        return response()->json( $loginResponse );
    }

    public function signup( SignupRequest $request ) {
        $signupData = $request->validated();
        DB::beginTransaction();
        try {
            $signupResponse = $this->authService->signup( $signupData );
            DB::commit();
            return response()->json( $signupResponse );
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
                'message' => 'Hubo un error al crear tu cuenta.'
            ], 500 );
        }

    }

}
