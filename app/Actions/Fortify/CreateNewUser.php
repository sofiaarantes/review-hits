<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'profile_photo' => ['nullable', 'image', 'max:2048'], 
            'tipo_usuario' => ['required', 'integer', 'in:1,2'], // 1 = usuario, 2 = admin
        ])->validate();

        $photoPath = null;

        if (request()->hasFile('profile_photo')) {
            $photoPath = request()->file('profile_photo')->store('profile-photos', 'public');
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tipo_usuario' => $input['tipo_usuario'],
            'profile_photo_path' => $photoPath,
        ]);
    }
}
