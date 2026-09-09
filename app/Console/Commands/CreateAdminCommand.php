<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin 
                            {--email= : Admin email address}
                            {--password= : Admin password (min 12 characters)}
                            {--name= : Admin full name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bootstrap or create an administrator account securely';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('=== PT. Anugerah Tama Sejati - Backoffice Administrator Setup ===');

        $email = $this->option('email') ?: $this->ask('Email Administrator');
        $name = $this->option('name') ?: $this->ask('Nama Administrator', 'Administrator ATS');

        $emailValidator = Validator::make(['email' => $email], [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($emailValidator->fails()) {
            $this->error('Email tidak valid: ' . $emailValidator->errors()->first('email'));
            return 1;
        }

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $this->warn("Pengguna dengan email '{$email}' sudah terdaftar.");
            if ($existingUser->role === 'admin' && $existingUser->is_active) {
                $this->info("Akun sudah aktif sebagai Admin. Password tidak ditimpa.");
                return 0;
            }

            if ($this->confirm("Jadikan pengguna ini sebagai Admin aktif tanpa mereset password?")) {
                $existingUser->update([
                    'role' => 'admin',
                    'is_active' => true,
                ]);
                $this->info("Akun berhasil diubah menjadi Admin aktif.");
                return 0;
            }

            return 1;
        }

        $password = $this->option('password');
        if (empty($password)) {
            $password = $this->secret('Password Administrator (minimal 12 karakter)');
            $passwordConfirmation = $this->secret('Konfirmasi Password Administrator');

            if ($password !== $passwordConfirmation) {
                $this->error('Konfirmasi password tidak cocok.');
                return 1;
            }
        }

        $passwordValidator = Validator::make(['password' => $password], [
            'password' => ['required', 'string', 'min:12'],
        ]);

        if ($passwordValidator->fails()) {
            $this->error('Password tidak memenuhi syarat: minimal 12 karakter.');
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->info("Akun Admin '{$user->email}' berhasil dibuat dan aktif.");
        return 0;
    }
}
