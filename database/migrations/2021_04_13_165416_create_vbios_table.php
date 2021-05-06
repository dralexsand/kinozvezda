<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateVbiosTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('vbios', function (Blueprint $table) {
                $table->integer('age');
                $table->id();
                $table->bigInteger('user_id');
                $table->string('last_name');
                $table->string('first_name');
                $table->date('birthday');
                $table->string('avatar');
                $table->string('gender');
                $table->text('short_bio');
                $table->text('bio');
                $table->string('email');
                $table->string('phone');
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
            Schema::dropIfExists('vbios');
        }
    }
