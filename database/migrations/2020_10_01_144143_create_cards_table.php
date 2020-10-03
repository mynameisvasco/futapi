<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("rating");
            $table->integer("rare_type");
            $table->integer("weak_foot");
            $table->string("weight");
            $table->string("height");
            $table->string("position");
            $table->string("display_name");
            $table->string("level");
            $table->string("foot");
            $table->string("def_work_rate");
            $table->string("att_work_rate");
            $table->string("name");
            $table->string("face_path");
            $table->integer("club_id")->unsigned();
            $table->integer("nation_id")->unsigned();
            $table->integer("league_id")->unsigned();
            $table->integer("skills");
            $table->integer("base_id");
            $table->integer("resource_id");
        });

        Schema::table('cards', function (Blueprint $table) {
            $table->foreign("club_id")->references("fifa_id")->on("clubs");
            $table->foreign("nation_id")->references("fifa_id")->on("nations");
            $table->foreign("league_id")->references("fifa_id")->on("leagues");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
