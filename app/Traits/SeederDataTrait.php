<?php


    namespace App\Traits;

    trait SeederDataTrait
    {

        public static function getRandomValuesFromArray(array $n)
        {
            $rand = rand(1, sizeof($n) - 1);
            $n = array_values($n);
            return $n[$rand];
        }


        public static function listImages($gender)
        {

            if (!in_array($gender, ['m', 'f'])) return [];

            //$base_path = '/public/upload/images/2021/04/07/';
            $base_path = '/upload/images/2021/04/07/';

            switch ($gender) {
                case 'm':
                    $n = 22;
                    break;
                case 'f':
                    $n = 12;
                    break;
            }

            $src = [];

            for ($i = 1; $i <= $n; $i++) {
                $src[] = $i;
            }

            $images = [];
            $quantity = rand(2, 7);

            $i = 0;
            while ($i < $quantity) {
                $val = self::getRandomValuesFromArray($src);
                $images[] = $val;
                unset($src[array_search($val, $src)]);
                $i++;
            }

            $imgs = [];
            foreach ($images as $image_number) {
                $imgs[] = $base_path . 'image_' . $gender . '_' . $image_number . '.jpg';
            }

            // image_f_1.jpg 12
            // image_m_1.jpg 22

            return $imgs;
        }

        public static function listRoles()
        {
            return [
                'administrator',
                'moderator',
                'registred_user',
            ];
        }

        public static function listGenres()
        {
            return [
                'comedy',
                'drama',
            ];
        }

        public static function listGenders()
        {
            return [
                'male',
                'female',
            ];
        }

        public static function listDramas()
        {
            return [
                'https://www.youtube.com/embed/jnLSYfObARA',
                'https://www.youtube.com/embed/2XX5zDThC3U',
                'https://www.youtube.com/embed/2Gg6Seob5Mg',
                'https://www.youtube.com/embed/iApVVKsF94E',
                'https://www.youtube.com/embed/43ngkc2Ejgw',
                'https://www.youtube.com/embed/HqAw_jGoEkI',
                'https://www.youtube.com/embed/4DTO4uHRKqQ',

            ];
        }

        public static function listComedies()
        {
            return [
                'https://www.youtube.com/embed/8kWMPTTMAY4',
                'https://www.youtube.com/embed/ssfuvE-8dRk',
                'https://www.youtube.com/embed/jw9crkSYaf4',
                'https://www.youtube.com/embed/n3brytBOv6E',
                'https://www.youtube.com/embed/ojI0YeG32uY',
                'https://www.youtube.com/embed/gJgXsaj_gR0',
                'https://www.youtube.com/embed/yLdA7ftaxCo',
            ];
        }

        public static function generateCarNumber()
        {
            $car_number = [];

            $car_number[0] = strtoupper(self::generateRandomString(1));
            $car_number[1] = rand(111, 999);
            $car_number[2] = strtoupper(self::generateRandomString(3));

            return implode('', $car_number);
        }

        public static function getRandomValueFromObject($obj)
        {
            $length = sizeof($obj);
            $arr = json_decode(json_encode($obj), true);
            return $arr[rand(0, $length - 1)];
        }

        public static function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public static function generateRandomStringOnlyLetters($length = 10)
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        public static function getRandomName()
        {
            $min = 3;
            $max = 10;
            $rand = rand($min, $max);

            $name = self::generateRandomStringOnlyLetters($rand);
            $name = ucfirst(strtolower($name));
            return $name;
        }

        public static function getRandomText($words_min = 50, $words_max = 200)
        {
            $words_quantity = rand($words_min, $words_max);
            $article = [];
            $i = 1;
            while ($i <= $words_quantity) {
                $rand_len_word = rand(3, 10);
                $article[] = strtolower(self::generateRandomStringOnlyLetters($rand_len_word));
                $i++;
            }

            return implode(' ', $article);
        }

        public static function listPostfixEmails()
        {
            return [
                'mail.com', 'gmail.com', 'hotmail.com', 'inbox.com', 'yahoo.com'
            ];
        }

        public static function getRandomPostfixEmails()
        {
            $list = self::listPostfixEmails();
            $rand = rand(0, sizeof($list) - 1);
            return $list[$rand];
        }

        public static function getRandomBirthday()
        {
            $timestamp = rand(strtotime("Jan 01 2000"), strtotime("Jan 01 2015"));
            return date("Y-m-d", $timestamp);
        }

        public static function getRandomVideo()
        {
            $list = self::listComedies();
            $comedy_id = rand(0, sizeof($list) - 1);
            $comedy = $list[$comedy_id];

            $list = self::listDramas();
            $drama_id = rand(0, sizeof($list) - 1);
            $drama = $list[$drama_id];

            return [
                'comedy' => $comedy,
                'drama' => $drama,
            ];
        }

        public static function getRandomPhoto()
        {
            $rand = rand(5, 10);
            $name = strtolower(self::generateRandomStringOnlyLetters($rand));
            return $name . '.jpg';
        }

        public static function getRandomInfo()
        {
            $bio = ucfirst(self::getRandomText());
            $short_bio = ucfirst(self::getRandomText(10, 20));

            $email_info = self::getRandomEmail();

            $last_name = strtolower($email_info['last_name']);
            $first_name = strtolower($email_info['first_name']);
            $email = $email_info['email'];

            return [
                'last_name' => ucfirst(strtolower($last_name)),
                'first_name' => ucfirst(strtolower($first_name)),
                'birthday' => self::getRandomBirthday(),
                'short_bio' => $short_bio,
                'bio' => $bio,
                'email' => $email,
            ];
        }

        public static function getRandomEmail()
        {
            $rand = rand(3, 10);
            $last_name = strtolower(self::generateRandomStringOnlyLetters($rand));
            $rand = rand(3, 10);
            $first_name = strtolower(self::generateRandomStringOnlyLetters($rand));
            $email = $last_name . '_' . $first_name . '@' . self::getRandomPostfixEmails();

            return [
                'last_name' => ucfirst(strtolower($last_name)),
                'first_name' => ucfirst(strtolower($first_name)),
                'email' => $email,
            ];
        }

        public static function parseEmail($email)
        {
            list($name, $postfix_email) = explode('@', $email);
            list($last_name, $first_name) = explode('_', $name);

            return [
                'last_name' => ucfirst(strtolower($last_name)),
                'first_name' => ucfirst(strtolower($first_name)),
            ];
        }


    }
