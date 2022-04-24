<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kontrol;
use App\Http\Controllers\GirisIslemleri;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//GİRİŞ YAPAN KULLANICI

Route::get("/ka",[Kontrol::class,"anasayfa2"])->name("anasayfa2");
Route::get("/ka/birimler",[Kontrol::class,"birimler"])->name("birimler");
Route::get("/ka/iletisim/",[Kontrol::class,"iletisim"])->name("iletisim");
Route::post("/ka/iletisim",[Kontrol::class,"iletisimPost"])->name("iletisimPost");
Route::get("/ka/sepet/{id}",[Kontrol::class,"sepetEkle"])->name("sepetEkle");
Route::get("/ka/sepetKaldir/{id}",[Kontrol::class,"sepetKaldir"])->name("sepetKaldir");
Route::get("/cikis-yapildi",[GirisIslemleri::class,"cikis"])->name("cikis");


//ADMİN 
Route::get("/ad/urun",[Kontrol::class,"anasayfa3"])->name("anasayfa3");
Route::post("/ad/urun",[Kontrol::class,"urunEkle"])->name("urunEkle");

Route::get("/ad/birimler",[Kontrol::class,"birimlerAdmin"])->name("birimlerAdmin");
Route::post("/ad/birimler",[Kontrol::class,"birimEkle"])->name("birimEkle");

Route::get("/duzenle/{id}",[Kontrol::class,"duzenle"])->name("duzenle");
Route::post("/duzenle/{id}",[Kontrol::class,"duzenlePost"])->name("duzenlePost");

Route::get("/duzenleBirim/{id}",[Kontrol::class,"duzenleBirim"])->name("duzenleBirim");
Route::post("/duzenleBirim/{id}",[Kontrol::class,"duzenleBirimPost"])->name("duzenleBirimPost");

Route::get("/kaldir/{id}",[Kontrol::class,"kaldir"])->name("kaldir");
Route::get("/kaldirBirim/{id}",[Kontrol::class,"kaldirBirim"])->name("kaldirBirim");

Route::get("ad/gelenKutusu",[Kontrol::class,"gelenKutusu"])->name("gelenKutusu");



// GİRİŞ YAPMAYAN KULLANICI
Route::get("/",[Kontrol::class,"anasayfa1"])->name("anasayfa1");
Route::get("/birimler",[Kontrol::class,"birimlerGY"])->name("birimlerGY");
Route::get("/iletisim",[Kontrol::class,"iletisimGY"])->name("iletisimGY");
Route::post("/iletisim",[Kontrol::class,"iletisimGYPost"])->name("iletisimGYPost");
Route::get("/giris",[Kontrol::class,"giris"])->name("giris");
Route::get("/kayitOl",[Kontrol::class,"kayit"])->name("kayitOl");
Route::get("/sepet/{id}",[Kontrol::class,"sepetEkleGY"])->name("sepetEkleGY");
Route::get("/sepetKaldir/{id}",[Kontrol::class,"sepetKaldirGY"])->name("sepetKaldirGY");


//post
Route::post("/kkk",[GirisIslemleri::class,"girisİslemi"])->name("girisPost");
Route::post("/lll",[GirisIslemleri::class,"kayitİslemi"])->name("kayitPost");

