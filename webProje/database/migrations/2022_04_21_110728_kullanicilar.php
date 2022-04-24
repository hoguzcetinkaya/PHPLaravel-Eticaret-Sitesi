<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kullanicilar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kullanicilar', function (Blueprint $table) {
            $table->id();
            $table->string("adsoyad");
            $table->string("seflink");
            $table->string("password");
            $table->string("email");
            $table->string("adres")->nullable();
            $table->string("telefon")->nullable();
            $table->enum('gorev',[1,2])->default(2);
            $table->enum('durum',[1,2])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kullanicilar');
    }
}
