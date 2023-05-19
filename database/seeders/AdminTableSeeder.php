<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     
        $admin=new User();
        $admin->name="John";
        $admin->email="afsar.rabblesoft@gmail.com";
        $admin->password=Hash::make("12345678");
        $admin->is_admin=true;
        $admin->save();        
    }
}
