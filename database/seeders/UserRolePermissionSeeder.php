<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
        DB::beginTransaction();
        try {
            $admin = User::create(array_merge([
                'email' => 'admin@gmail.com',
                'name' => 'admin',
            ], $default_user_value));
            $kepsek = User::create(array_merge([
                'email' => 'kepsek@gmail.com',
                'name' => 'kepsek',
            ], $default_user_value));
            $guru = User::create(array_merge([
                'email' => 'guru@gmail.com',
                'name' => 'guru',
            ], $default_user_value));
            $siswa = User::create(array_merge([
                'email' => 'siswa@gmail.com',
                'name' => 'siswa',
            ], $default_user_value));
            $role_admin= Role::create(['name' => 'ADMIN']);
            $role_kepsek = Role::create(['name' => 'KEPSEK']);
            $role_guru = Role::create(['name' => 'GURU']);
            $role_siswa = Role::create(['name' => 'SISWA']);

            $permission = Permission::create(['name' => 'CRUD ADMIN']);
            $permission = Permission::create(['name' => 'CRUD KEPSEK']);
            $permission = Permission::create(['name' => 'CRUD GURU']);
            $permission = Permission::create(['name' => 'CRUD SISWA']);

            $role_admin->givePermissionTo('CRUD ADMIN');
            $role_siswa->givePermissionTo('CRUD KEPSEK');

            $admin->assignRole('ADMIN');
            $guru->assignRole('GURU');
            $kepsek->assignRole('KEPSEK');
            $siswa->assignRole('SISWA');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

        }
    }
}
