<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTagsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                "name"=>"laravel",
            ],
            [
                "name"=>"thinkphp",
            ],
            [
                "name"=>"php",
            ],
        ];
        DB::table("tags")->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table("tags")->truncate();
    }
}
