<?php

    namespace Database\Seeders;

    use App\Traits\SeederDataTrait;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class PhotoSeeder extends Seeder
    {

        use SeederDataTrait;

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {

            $users = DB::table('bios')->get();

            foreach ($users as $user) {

                $gender = $user->gender_id == 1 ? 'm' : 'f';
                $images = self::listImages($gender);

                foreach ($images as $key => $image) {

                    $date = date('Y-m-d H:i:s');
                    $is_avatar = $key == 0 ? 1 : 0;

                    DB::table('photos')->insert([
                        'user_id' => $user->user_id,
                        'path' => $image,
                        'is_avatar' => $is_avatar,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }

                /*$rand = rand(1, 10);
                $i = 1;

                while ($i <= $rand) {

                    $date = date('Y-m-d H:i:s');
                    $is_avatar = $i == 1 ? 1 : 0;

                    DB::table('photos')->insert([
                        'user_id' => $user->id,
                        'path' => self::getRandomPhoto(),
                        'is_avatar' => $is_avatar,
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);

                    $i++;
                }*/

            }

        }
    }
