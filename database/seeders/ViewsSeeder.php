<?php

    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class ViewsSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $sql = "DROP TABLE IF EXISTS vbios";

            DB::statement($sql);

            $sql = "CREATE TABLE vbios AS
    (SELECT
        TIMESTAMPDIFF(YEAR,
            bios.birthday,
            CURDATE()) AS age,
        bios.id,
        bios.user_id,
        bios.last_name,
        bios.first_name,
        bios.birthday,
        photos.path as avatar,
        genders.gender,
        bios.short_bio,
        bios.bio,
        bios.email,
        bios.phone,
        bios.created_at,
        bios.updated_at
    FROM bios
    JOIN genders ON genders.id = bios.gender_id
    JOIN photos ON photos.user_id = bios.user_id AND photos.is_avatar=1
    WHERE bios.verified_email = 1)";

            DB::statement($sql);

        }
    }
