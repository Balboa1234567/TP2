<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des Permissions 

        Permission::create(['name' => 'create-article', 'guard_name'=>'web']);
        Permission::create(['name' => 'edit-article','guard_name'=>'web']);
        Permission::create(['name' => 'delete-article','guard_name'=>'web']);
    
        Permission::create(['name' => 'create-comment','guard_name'=>'web']);
        Permission::create(['name' => 'edit-comment','guard_name'=>'web']);
        Permission::create(['name' => 'delete-comment','guard_name'=>'web']);
    }
 }

