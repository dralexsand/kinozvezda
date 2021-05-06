<?php

    namespace Database\Seeders;

    use App\Traits\SeederDataTrait;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class BioSeeder extends Seeder
    {
        use SeederDataTrait;

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $users = DB::table('users')->get();

            foreach ($users as $user) {

                $date = date('Y-m-d H:i:s');
                $info = self::parseEmail($user->email);

                DB::table('bios')->insert([
                    'user_id' => $user->id,
                    'last_name' => $info['last_name'],
                    'first_name' => $info['first_name'],
                    'gender_id' => rand(1, 2),
                    'birthday' => self::getRandomBirthday(),
                    'short_bio' => self::getRandomText(10, 20),
                    'bio' => self::getRandomText(),
                    'email' => $user->email,
                    'verified_email' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

            }

        }
    }

    /*

    id, user_id, last_name, first_name, birthday, short_bio,
    bio, email, verified_email, phone, created_at, updated_at


    $table->bigInteger('user_id');
    $table->string('last_name');
    $table->string('first_name');
    $table->date('birthday');
    $table->text('short_bio');
    $table->text('bio');
    $table->string('email');
    $table->smallInteger('verified_email')->default(0);
    $table->string('phone')->nullable();

    */
