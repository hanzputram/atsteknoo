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
                            {--username= : Admin username}
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

        $username = $this->option('username') ?: $this->ask('Username Administrator', 'superats888');
        $email = $this->option('email') ?: $this->ask('Email Administrator');
        $name = $this->option('name') ?: $this->ask('Nama Administrator', 'Administrator ATS');

        $validator = Validator::make([
            'username' => $username,
            'email' => $email,
        ], [
            'username' => ['nullable', 'string', 'max:50', 'alpha_dash'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error('Validasi gagal: ' . $validator->errors()->first());
            return 1;
        }

        $existingUser = User::where('email', $email)
            ->when($username, fn($q) => $q->orWhere('username', $username))
            ->first();

        if ($existingUser) {
            $this->warn("Pengguna dengan email '{$existingUser->email}' atau username '{$existingUser->username}' sudah terdaftar.");
            if ($existingUser->role === 'admin' && $existingUser->is_active) {
                if ($username && $existingUser->username !== $username) {
                    $existingUser->update(['username' => $username]);
                    $this->info("Username akun diperbarui menjadi '{$username}'.");
                }
                $this->info("Akun sudah aktif sebagai Admin. Password tidak ditimpa.");
                return 0;
            }

            if ($this->confirm("Jadikan pengguna ini sebagai Admin aktif tanpa mereset password?")) {
                $existingUser->update([
                    'username' => $username ?: $existingUser->username,
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
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->info("Akun Admin '{$user->username}' ({$user->email}) berhasil dibuat dan aktif.");
        return 0;
    }
}
