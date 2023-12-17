<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'esra', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            
        ]);
    
        $role = Role::create(['id'=> 1,'name' => 'مدير نظام']);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);

          //  //4
          $role4 = Role::create(['id'=> 14,'name' => 'عرض الرسائل المرسلة']);
          $permissions4 = Permission::whereIn('id', [22])->pluck('id','id')->all();
          $role4->syncPermissions($permissions4);
 //
 
          $role5 = Role::create(['id'=> 5,'name' => 'إرسال رسالة']);
          $permissions5 = Permission::whereIn('id', [23])->pluck('id','id')->all();
          $role5->syncPermissions($permissions5);
 
          $role6 = Role::create(['id'=> 6,'name' => 'تحميل ملف excel لارسال رسائل']);
          $permissions6 = Permission::whereIn('id', [24])->pluck('id','id')->all();
          $role6->syncPermissions($permissions6);

    

         



    }
}
