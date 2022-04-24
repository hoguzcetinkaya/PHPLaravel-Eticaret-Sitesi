<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Iletisim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iletisim', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("baslik");
            $table->string("mesaj");
            $table->enum("durum",[1,2])->default(1);
            $table->unsignedBigInteger("kullanici_id")->nullable();// FOREIGN KEY TANIMLAMA unsignedBigInteger
            $table->timestamps();
            $table->foreign("kullanici_id")->references("id")->on("kullanicilar")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iletisim');
    }
}
