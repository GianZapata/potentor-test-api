<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService {
    public function __construct() {}

    public function login( $loginData ): array {

        $user = User::where('email', $loginData['email'])->first();

        if (!$user || !Hash::check($loginData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son validas, revisa si tu correo electrónico o tu contraseña son correctos'],
            ]);
        }

        return $this->createUserResponse($user);
    }

    public function signup( $signupData ): array {

        $user = User::where('email', $signupData['email'])->first();

        if( $user ) {
            throw ValidationException::withMessages([
                'email' => ['Ya existe un usuario con ese correo, intenta ingresando otro.'],
            ]);
        }

        $newUser = User::create([
            'name'      => $signupData['name'],
            'email'     => $signupData['email'],
            'password'  => Hash::make($signupData['password']),
        ]);

        return $this->createUserResponse($newUser);
    }

    private function createUserResponse( User $user ): array {
        $accessToken = $user->createToken('access_token')->plainTextToken;
        return [
            'user'  => $user,
            'token' => $accessToken
        ];
    }

}
