<?php

    namespace App\Models;

    use DateTime;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Bio extends ApiModel
    {
        use HasFactory;

        protected $guarded = [];

        public function gender()
        {
            return $this->belongsTo(Gender::class, 'id', 'gender_id');
        }

        /*public function user(){
            return $this->belongsTo('user');
        }*/

        public static function getAgeFromBirthday0($birthday)
        {
            $birthday_timestamp = strtotime($birthday);
            $age = date('Y') - date('Y', $birthday_timestamp);
            if (date('md', $birthday_timestamp) > date('md')) {
                $age--;
            }
            return $age;
        }

        public static function getAgeFromBirthday($birthday)
        {
            $date = new DateTime($birthday);
            $now = new DateTime();
            $interval = $now->diff($date);
            return $interval->y;
        }

        public static function getBirthdayFromAge($age)
        {
            list($year, $month, $day) = explode("-", date("Y-m-d"));
            $range = $year - $age;
            return strtotime("{$range}-{$month}-{$day}");
            //return strtotime("{$range}-{$month}");
        }


    }
