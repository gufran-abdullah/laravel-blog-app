<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'first_name')) {
            Schema::table('users', function(Blueprint $table) {
                $table->string('first_name', 150)->nullable()->after('name');
            });
        }
        if (!Schema::hasColumn('users', 'last_name')) {
            Schema::table('users', function(Blueprint $table) {
                $table->string('last_name', 150)->nullable()->after('first_name');
            });
        }
        if (!Schema::hasColumn('users', 'user_image')) {
            Schema::table('users', function(Blueprint $table) {
                $table->string('user_image', 255)->nullable()->after('remember_token');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
