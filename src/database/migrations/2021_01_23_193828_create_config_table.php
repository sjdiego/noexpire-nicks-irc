<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    public function up()
    {
        Schema::table('config', function ($collection) {
            $collection->unique('key');
        });
    }

    public function down()
    {
        Schema::table('config', function ($collection) {
            $collection->dropIndex('key_1');
        });
        Schema::drop('config');
    }
}
