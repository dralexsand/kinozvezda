<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Gender extends ApiModel
    {
        use HasFactory;

        //protected $guarded = [];
        protected $fillable = ['gender'];

        public function bio()
        {
            return $this->hasMany(Bio::class, 'gender_id', 'id');
        }
    }
