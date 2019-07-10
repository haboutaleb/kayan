<?php

use Illuminate\Database\Seeder;
use App\Model\AdministrationGroup;
use App\User;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administration_group = new AdministrationGroup();

        $administration_group->permissions = "*";
        $administration_group->description = "";
        $administration_group->save();

        $super_admin = new User();
        $super_admin->administration_group_id = $administration_group->id;
        $super_admin->email = "elsherbiny28@icloud.com";
        $super_admin->password = bcrypt('123456789');
        $super_admin->mobile = "01008414435";
        $super_admin->type = "super_admin";
        $super_admin->full_name = "admin";
        $super_admin->last_name = "istrator";
        $super_admin->gender = "male";
        $super_admin->active = "active";
        $super_admin->save();
    }
}
