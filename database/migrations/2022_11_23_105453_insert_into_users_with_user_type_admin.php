<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $table = DB::table("users");
        $new = [
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => "$2y$10$.0xj7pVcBwqcjuNk/Ztmae2dJsAXZoj7047sd4jDMrv.sagF5yA6.",
            "user_type" => "admin",
        ];
        $table->insert($new);
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
