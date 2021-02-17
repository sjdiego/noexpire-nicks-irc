<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNicksTable extends Migration
{
    public function up()
    {
        Schema::create('nicks', function ($collection) {
            $collection->unique('name');
        });
    }

    public function down()
    {
        Schema::table('nicks', function ($collection) {
            $collection->dropIndex('name_1');
        });
        Schema::drop('nicks');
    }
}
