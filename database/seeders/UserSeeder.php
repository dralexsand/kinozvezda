<?php

    namespace Database\Seeders;

    use App\Traits\SeederDataTrait;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        use SeederDataTrait;

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $list = self::listGenders();

            $date = date('Y-m-d H:i:s');

            $i = 1;
            $quantity = 1713;

            while ($i <= $quantity) {

                $min = 3;
                $max = 10;
                $rand = rand($min, $max);

                $email_info = self::getRandomEmail();

                DB::table('users')->insert([
                    'name' => strtolower(self::generateRandomStringOnlyLetters($rand)),
                    'email' => strtolower($email_info['email']),
                    'email_verified_at' => $date,
                    'password' => Hash::make('password'),
                    'role_id' => 3,
                    'token' => md5($email_info['last_name']),
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                $i++;

            }
        }
    }

