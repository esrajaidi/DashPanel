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

          //  //1
          $role2 = Role::create(['id'=> 2,'name' => 'عرض الرسائل المرسلة']);
          $permissions2 = Permission::whereIn('id', [14])->pluck('id','id')->all();
          $role2->syncPermissions($permissions2);
 //
 
          $role3 = Role::create(['id'=> 3,'name' => 'إرسال رسالة']);
          $permissions3 = Permission::whereIn('id', [15])->pluck('id','id')->all();
          $role3->syncPermissions($permissions3);
 
          $role4 = Role::create(['id'=> 4,'name' => 'تحميل ملف excel لارسال رسائل']);
          $permissions4 = Permission::whereIn('id', [16])->pluck('id','id')->all();
          $role4->syncPermissions($permissions4);

    
          $role5 = Role::create(['id'=> 5,'name' => 'إدارة  قوائم الحظر المحلية']);
          $permissions5 = Permission::whereIn('id', [17,18,19,20,21])->pluck('id','id')->all();
          $role5->syncPermissions($permissions5);


         



    }
}
