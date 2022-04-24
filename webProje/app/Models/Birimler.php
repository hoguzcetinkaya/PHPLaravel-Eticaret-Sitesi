<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birimler extends Model
{
    use HasFactory;
    protected $table="birimler";
    protected $fillable=["resim","adsoyad","seflink","meslekiGorev","instagram","twitter","facebook","durum","created_at","updated_at"];
}
