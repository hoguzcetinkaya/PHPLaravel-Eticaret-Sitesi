<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urunler extends Model
{
    use HasFactory;
    protected $table="urunler";
    protected $fillable=["resim","resim1","resim2","resim3","urunAd","urunFiyat","kategori","durum","created_at","updated_at"];
}
