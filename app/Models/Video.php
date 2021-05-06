<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\DB;

    class Video extends ApiModel
    {
        use HasFactory;

        protected $guarded = [];


        public static function getVideoByUser($user_id)
        {
            return DB::table('videos')
                ->join('genres', 'genres.id', '=', 'videos.genre_id')
                ->where('user_id', '=', $user_id)
                ->select(
                    'videos.id', 'videos.path', 'videos.user_id',
                    'genres.genre'
                )
                ->get();
        }
    }
