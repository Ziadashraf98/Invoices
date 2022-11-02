<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$user = User::create([
'name' => 'Ziad',
'email' => 'ziadshalaby98@gmail.com',
'password' => bcrypt('1973'),
'status'=>'مفعل',
]);
$role = Role::create(['name' => 'owner']);
$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);
$user->assignRole([$role->id]);
}
}