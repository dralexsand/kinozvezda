<?php

    namespace Database\Seeders;

    use App\Traits\SeederDataTrait;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class VideoSeeder extends Seeder
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
            $videos = self::getRandomVideo();

            foreach ($users as $user) {

                $date = date('Y-m-d H:i:s');

                DB::table('videos')->insert([
                    'user_id' => $user->id,
                    'path' => $videos['comedy'],
                    'genre_id' => 1,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                $date = date('Y-m-d H:i:s');

                DB::table('videos')->insert([
                    'user_id' => $user->id,
                    'path' => $videos['drama'],
                    'genre_id' => 2,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }

