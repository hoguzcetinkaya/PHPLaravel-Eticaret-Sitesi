<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kullanicilar extends Authenticatable
{
    use HasFactory;
    protected $table="kullanicilar";
    protected $fillable=["adsoyad","seflink","password","email","adres","telefon","gorev","durum","created_at","updated_at"];
}
