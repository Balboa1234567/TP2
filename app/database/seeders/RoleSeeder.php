<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'writer', 'guard_name' => 'web']);
        Role::create(['name' => 'Editor', 'guard_name' => 'web']);
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);

        // Assignation des Roles pour gérer les Articles

       $editorRole = Role::findByName('editor');
       $editorRole->givePermissionTo('create-article', 'edit-article', 'delete-article');

       $adminRole = Role::findByName('admin');
       $adminRole->givePermissionTo(Permission::all());

        // Assignation des Roles pour gérer les commentaires

       $editorRole= Role::findbyName('writer');
       $editorRole= Role::givePermissionTo('create-comment');

       $editorRole = Role::findbyName('editor');
       $editorRole= Role::givePermissionTo('create-comment','edit-comment','delete-comment');

       $editorRole = Role::findbyName('admin');
       $editorRole= Role::givePermissionTo(Permission::all());

}
}