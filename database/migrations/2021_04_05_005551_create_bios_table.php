<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateBiosTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('bios', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id');
                $table->string('last_name');
                $table->string('first_name');
                $table->date('birthday');
                $table->smallInteger('gender_id');
                $table->text('short_bio');
                $table->text('bio');
                $table->string('email');
                $table->smallInteger('verified_email')->default(0);
                $table->string('phone')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('bios');
        }
    }
