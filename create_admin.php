<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = \App\Models\User::firstOrCreate(
    ['email' => 'admin@test.com'],
    ['name' => 'Admin', 'password' => bcrypt('password')]
);
$u->is_admin = true;
$u->save();
echo "Admin created \n";
