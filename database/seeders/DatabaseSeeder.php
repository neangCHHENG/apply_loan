<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetMovement;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\AssetType;
use App\Models\AssetTypeAttribute;
use App\Models\Mainvaluelist;
use App\Models\UserCampus;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $user = new User();
        $user->CardId = null;
        $user->name = 'Administrator';
        $user->email = '';
        $user->username = 'admin';
        $user->password = bcrypt('Abc@123');
        $user->maker = 1;
        $user->save();

        $role = new Role();
        $role->name = 'Admin';
        $role->isAdmin = true;
        $role->description = 'System Administrator';
        $role->isDefault = true;
        $role->save();

        $role1 = new Role();
        $role1->name = 'Default';
        $role1->isAdmin = false;
        $role1->description = 'Limited Action';
        $role1->isDefault = true;
        $role1->save();

        $user->roles()->attach($role->id);

        // $ds = new DatabaseSeeder();
        // $ds->addMVL();
        // $ds->addUser();

        $this->call([
            CategoryArticle::class,
            Type_config::class,
            Type::class,
        ]);
    }
}
