<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToComplaintsTable extends Migration
{
    public function up()
    {
        // Schema::table('complaints', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user_id')->after('id');

        //     // Buat foreign key supaya hubungan dengan tabel users terjaga
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
