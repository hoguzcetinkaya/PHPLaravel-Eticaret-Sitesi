<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Urunler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urunler', function (Blueprint $table) {
            $table->id();
            $table->string("resim");
            $table->string("resim2")->nullable();
            $table->string("resim3")->nullable();
            $table->string("urunAd");
            $table->string("urunFiyat");
            $table->string("kategori");
            $table->enum('durum',[1,2])->default(1);
            $table->enum('sepet',[1,2])->default(1);
            $table->enum('sepetGY',[1,2])->default(1);
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
        Schema::dropIfExists('urunler');
    }
}
