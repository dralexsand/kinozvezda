<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Photo extends ApiModel
    {
        use HasFactory;

        protected $guarded = [];


        public static function getPhotoByUser($user_id)
        {
            //return Photo::where('user_id', '=', $user_id)->get();
            return DB::table('photos')
                ->where('user_id', '=', $user_id)
                ->select('id', 'path', 'is_avatar', 'user_id')
                ->get();
        }

        public static function getPhotoAvatarByUser($user_id)
        {
            //return Photo::where('user_id', '=', $user_id)->get();
            return DB::table('photos')
                ->where('user_id', '=', $user_id)
                ->where('is_avatar', '=', 1)
                ->select('id', 'path', 'is_avatar', 'user_id')
                ->get();
        }

    }
