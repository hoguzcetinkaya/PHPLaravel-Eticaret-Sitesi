<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Kullanicilar;
use App\Models\Urunler;

use Illuminate\Http\Request;

class GirisIslemleri extends Controller
{
    
    public function girisİslemi(Request $request)
    {
        
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->sifre]))
        {
            echo $request->email;
            $kullanici=Kullanicilar::where("email",$request->email)->first();
            if($kullanici->email=="admin@gmail.com")
            {
                Kullanicilar::where("seflink","admin")->update([
                    "gorev"=>1
                ]);
                return redirect()->route('anasayfa3');
            }
            else
            {
                return redirect()->route('anasayfa2');
            }
            
        }

    }
    public function kayitİslemi(Request $request)
    {
        $request->validate([
            "adsoyad"=>'required',
            "email"=>'required',
            "password"=>'required'
        ]);

        $kullaniciKontrol=Kullanicilar::where("email",$request->email)->first(); //bu emaile bağlı kullanıcı var mı ?
        if($kullaniciKontrol)
        {
            return redirect()->route("kayitOl")->with("hata","Sistemde kayıtlı öğrenci girmek istediniz !!"); // redirect yönlendirme
        }
        else
        {
            $kullaniciSeflink=Str::of($request->adsoyad)->slug('');
            Kullanicilar::create([
                "adsoyad"=>$request->adsoyad,
                "seflink"=>$kullaniciSeflink,
                "password"=>bcrypt($request->sifre),
                "email"=>$request->email,
                "adres"=>$request->adres,
                "telefon"=>$request->telefon,
            ]);

            return redirect()->route("giris")->with("basarili","Kayıt olma işlemi başarılı");
        }
    }
    public function cikis()
    {
        $urunler=Urunler::where("sepet",2)->get();
        foreach($urunler as $urun)
        {
            Urunler::where("sepet",2)->update([
                "sepet"=>1
            ]);
        }
        Auth::logout();
        return redirect()->route("anasayfa1");
        //yönlendirme
    }
    
}
