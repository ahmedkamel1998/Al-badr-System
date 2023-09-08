<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'ahmed kamel',
            'email' => 'ak2391439@gmail.com',
            'password' => bcrypt('123456'),
            'roles_name' => ['owner'],
            'status' => 'مفعل',
            ]);
            $role = Role::create(['name' => 'owner']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
    }
}
