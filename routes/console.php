<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create {email} {--name=Administrator}', function () {
    $email = (string) $this->argument('email');
    $validator = Validator::make(['email' => $email], ['email' => ['required', 'email']]);

    if ($validator->fails()) {
        $this->error($validator->errors()->first('email'));

        return 1;
    }

    $plainPassword = password('Password admin (minimal 8 karakter)', required: true);
    if (mb_strlen($plainPassword) < 8) {
        $this->error('Password minimal 8 karakter.');

        return 1;
    }

    $user = User::query()->firstOrNew(['email' => $email]);
    $user->forceFill([
        'name' => (string) $this->option('name'),
        'password' => Hash::make($plainPassword),
        'is_admin' => true,
        'email_verified_at' => now(),
    ])->save();

    $this->info("Administrator {$user->email} siap digunakan.");

    return 0;
})->purpose('Create or promote an administrator account');
