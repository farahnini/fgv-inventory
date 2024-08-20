<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete',
        'category-list',
        'category-create',
        'category-edit',
        'category-delete',
        'item-list',
        'item-create',
        'item-edit',
        'item-delete'
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UsersTableSeeder::class);

        $user = User::factory()->create([
            'name' => 'Abu bin Ali',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
