<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            [
                'name' => 'مدير',
                'description' => 'جميع صلاحيات لوحه تحكم الإداره',
            ],[
                'name' => 'مشرف',
                'description' => 'الإشراف علي قسم أو مجموعه من الأقسام',
            ],[
                'name' => 'عضويه بدون صلاحيات',
                'description' => '',
            ],
        ]);
    }
}
