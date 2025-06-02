<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Siswa; //ditambah ini
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException; //ditambah ini
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Models\Guru; //tambah ini

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     * digunakan untuk memproses pendaftaran user baru
     * @param  array<string, string>  $input
     * 
     */
    public function create(array $input): User
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => $this->passwordRules(),
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
    ])->validate();

    // Cek email di siswa atau guru
    $isSiswa = Siswa::where('email', $input['email'])->exists();
    $isGuru = Guru::where('email', $input['email'])->exists();

    if (!$isSiswa && !$isGuru) {
        throw ValidationException::withMessages([
            'email' => 'Email tidak terdaftar sebagai siswa atau guru.',
        ]);
    }

    // Buat user
    $user = User::create([
        'name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password']),
    ]);

    // Tentukan role lalu assign
    if ($isSiswa) {
        $user->assignRole('siswa');
    } elseif ($isGuru) {
        $user->assignRole('guru');
    }

    return $user;
}
}