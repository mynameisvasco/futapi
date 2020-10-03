<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->ipAddress("created_ip");
            $table->ipAddress("last_login_ip");
            $table->timestamp("last_login_at", 0)->useCurrent();
            $table->integer("num_requests_today")->default(0);
            $table->integer("telegram_user_id")->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table("users", function (Blueprint $table) {
            $table->foreignId("role_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
