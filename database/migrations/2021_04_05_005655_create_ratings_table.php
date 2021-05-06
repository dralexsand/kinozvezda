<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateRatingsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('ratings', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('table_row_id');
                $table->string('table_name');
                $table->bigInteger('voices')->default(0);
                $table->bigInteger('sum_ratings')->default(0);
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
            Schema::dropIfExists('ratings');
        }
    }
