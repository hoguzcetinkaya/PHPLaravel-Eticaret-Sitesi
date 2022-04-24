<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iletisim extends Model
{
    use HasFactory;
    protected $table="iletisim";
    protected $fillable=["email","baslik","mesaj","durum","kullanici_id","created_at","updated_at"];
}
