<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        schema::table('posts', function ($table){

            $table->string('slug')->unique()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts',function ($table){

            $table->dropColumn('slug');

        });
    }
}

# see video part 22 (12:52) add composer.json to avoid getting error .
#Dropping Columns
# add "doctrine/dbal": "*" to composer.json
# composer update
#https://laravel.com/docs/5.3/migrations#dropping-columns
