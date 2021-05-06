<?php

namespace Database\Seeders;

use App\Traits\SeederDataTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    use SeederDataTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = self::listRoles();
        $date = date('Y-m-d H:i:s');

        foreach ($list as $item){
            DB::table('roles')->insert([
                'role' => $item,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
