<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Kullanicilar;
use App\Models\Urunler;
use App\Models\Birimler;
use App\Models\Iletisim;

use Illuminate\Http\Request;

class Kontrol extends Controller
{
    
    function anasayfa1()
    {
        $genelToplam=0;
        $sayac=0;
        $urunler=Urunler::where("durum",1)->get();
        $urunler2=Urunler::where("sepetGY",2)->get();
        foreach($urunler2 as $urun)
        {
            $sayac++;
            $toplam=$urun->urunFiyat;
            $genelToplam=$genelToplam+$toplam;
        }
        return view("index",compact(['urunler','genelToplam','sayac']));
    }
    function anasayfa2()
    {
        $genelToplam=0;
        $sayac=0;
        $urunler=Urunler::where("durum",1)->get();
        $urunler2=Urunler::where("sepet",2)->get();
        foreach($urunler2 as $urun)
        {
            $sayac++;
            $toplam=$urun->urunFiyat;
            $genelToplam=$genelToplam+$toplam;
        }
        return view("index2",compact(['urunler','genelToplam','sayac']));
    }
    function anasayfa3()
    {
        $urunler=Urunler::where("durum",1)->get();
        
        
        return view("index3",compact('urunler'));
    }
    function birimler()
    {
        $birimler=Birimler::where("durum",1)->get();
        return view("birimler",compact('birimler'));
    }
    function iletisim()
    {

        return view("iletisim");
    }
    function iletisimPost(Request $request)
    {
        $kullanici=Kullanicilar::where("email",$request->email)->first();
        if(!empty($request->baslik) && !empty($request->mesaj))
        {
            Iletisim::create([
                "email"=>$request->email,
                "baslik"=>$request->baslik,
                "mesaj"=>$request->mesaj,
                "kullanici_id"=>$kullanici->id
            ]);
            return redirect()->route('iletisim')->with("basarili","Mesajınız alınmıştır en kısa sürede dönüş sağlayacağız.");
        }
        else
        {
            return redirect()->back()->with("hata","Boş alan bırakmayınız");
        }
        
    }
    function sepetEkle($urunID)
    {
        $urun=Urunler::where("id",$urunID)->first();
        Urunler::where("id",$urunID)->update([
            "sepet"=>2
        ]);
        return redirect()->back();
        
    }
    function sepetKaldir($urunID)
    {
        $urun=Urunler::where("id",$urunID)->first();
        Urunler::where("id",$urunID)->update([
            "sepet"=>1
        ]);
        return redirect()->back();
        
    }
    function sepetEkleGY($urunID)
    {
        $urun=Urunler::where("id",$urunID)->first();
        Urunler::where("id",$urunID)->update([
            "sepetGY"=>2
        ]);
        return redirect()->back();
        
    }
    function sepetKaldirGY($urunID)
    {
        $urun=Urunler::where("id",$urunID)->first();
        Urunler::where("id",$urunID)->update([
            "sepetGY"=>1
        ]);
        return redirect()->back();
        
    }
    function birimlerAdmin()
    {
        $birimler=Birimler::where("durum",1)->get();
        return view("birimEkle",compact('birimler'));
    }
    function giris()
    {
        return view('girisYap');
    }
    function kayit()
    {
        return view('kayitOl');
    }

    //ürün ekleme
    function urunEkle(Request $request)
    {
        if(!empty($request->urunAd) && !empty($request->urunFiyat))
        {
            if($request->resim==true)
            {
                if($request->resim2==true)
                {
                    if($request->resim3==true)
                    {
                        //resim 1
                        $resimDosyasi1=$request->file('resim');
                        $resim=$resimDosyasi1->getClientOriginalName();
                        $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                        //resim 2
                        $resimDosyasi2=$request->file('resim2');
                        $resim2=$resimDosyasi2->getClientOriginalName();
                        $resimDosyasi2->move(public_path("images/".$request->urunAd),$resim2);
                        //resim 3
                        $resimDosyasi3=$request->file('resim3');
                        $resim3=$resimDosyasi3->getClientOriginalName();
                        $resimDosyasi3->move(public_path("images/".$request->urunAd),$resim3);
                        Urunler::create([
                            "resim"=>$resim,
                            "resim2"=>$resim2,
                            "resim3"=>$resim3,
                            "urunAd"=>$request->urunAd,
                            "urunFiyat"=>$request->urunFiyat,
                            "kategori"=>$request->kategori
                        ]);
                        return redirect()->back()->with("basarili","Ürün ekleme başarılı ürün ile ilgili 3 adet resim seçtiniz.");
                    }
                    else
                    {
                        //resim 1
                        $resimDosyasi1=$request->file('resim');
                        $resim=$resimDosyasi1->getClientOriginalName();
                        $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                        //resim 2
                        $resimDosyasi2=$request->file('resim2');
                        $resim2=$resimDosyasi2->getClientOriginalName();
                        $resimDosyasi2->move(public_path("images/".$request->urunAd),$resim2);
                        Urunler::create([
                            "resim"=>$resim,
                            "resim2"=>$resim2,
                            "urunAd"=>$request->urunAd,
                            "urunFiyat"=>$request->urunFiyat,
                            "kategori"=>$request->kategori
                        ]);
                        return redirect()->back()->with("basarili","Ürün ekleme başarılı ürün ile ilgili 2 adet resim seçtiniz.");
                    }
                   
                    
                }
                else
                { 
                    //resim 1
                    $resimDosyasi1=$request->file('resim');
                    $resim=$resimDosyasi1->getClientOriginalName();
                    $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                    Urunler::create([
                        "resim"=>$resim,
                        "urunAd"=>$request->urunAd,
                        "urunFiyat"=>$request->urunFiyat,
                        "kategori"=>$request->kategori
                    ]);
                     return redirect()->back()->with("basarili","Ürün ekleme başarılı ürün ile ilgili 1 adet resim seçtiniz.");
    
                }
                
            }
            else
            {
                
                 return redirect()->back()->with("hata","Ürün ekleme başarısız 1. resim alanını doldurmanız zorunludur");
            }
        }
        else
        {
            return redirect()->back()->with("hata","Ürün ile ilgili gerekli bilgileri doldurunuz !!");
        }
        
        

    }
    function birimEkle(Request $request)
    {
        if(!empty($request->adsoyad) && !empty($request->resim) && !empty($request->meslekiGorev) && !empty($request->instagram) && !empty($request->twitter) && !empty($request->facebook))
        {
            $resimDosyasi=$request->file('resim');
            $resim=$resimDosyasi->getClientOriginalName();
            $birimSeflink=Str::of($request->adsoyad)->slug('');
            $resimDosyasi->move(public_path("images/".$birimSeflink),$resim);

            Birimler::create([
                "resim"=>$resim,
                "adsoyad"=>$request->adsoyad,
                "seflink"=>$birimSeflink,
                "meslekiGorev"=>$request->meslekiGorev,
                "instagram"=>$request->instagram,
                "twitter"=>$request->twitter,
                "facebook"=>$request->facebook
            ]);
            return redirect()->back()->with("basarili","Birim eklendi..");
        }
        else
        {
            return redirect()->back()->with("hata","Birim eklenemedi boş alan bırakmayınız...");
        }
    }
    function duzenle($urunID)
    {
        $urunBilgi=Urunler::where("id",$urunID)->first();
        return view("duzenle",compact('urunBilgi'));
    }
    function duzenlePost(Request $request,$urunID)
    {
        if(!empty($request->urunAd) && !empty($request->urunFiyat))
        {
            if($request->resim==true)
            {
                if($request->resim2==true)
                {
                    if($request->resim3==true)
                    {
                        //resim 1
                        $resimDosyasi1=$request->file('resim');
                        $resim=$resimDosyasi1->getClientOriginalName();
                        $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                        //resim 2
                        $resimDosyasi2=$request->file('resim2');
                        $resim2=$resimDosyasi2->getClientOriginalName();
                        $resimDosyasi2->move(public_path("images/".$request->urunAd),$resim2);
                        //resim 3
                        $resimDosyasi3=$request->file('resim3');
                        $resim3=$resimDosyasi3->getClientOriginalName();
                        $resimDosyasi3->move(public_path("images/".$request->urunAd),$resim3);
                        Urunler::where("id",$urunID)->update([
                            "resim"=>$resim,
                            "resim2"=>$resim2,
                            "resim3"=>$resim3,
                            "urunAd"=>$request->urunAd,
                            "urunFiyat"=>$request->urunFiyat,
                        ]);
                        return redirect()->back()->with("basarili","Ürün güncelleme başarılı ürün ile ilgili tüm fotoğrafları güncellediniz.");
                    }
                    else
                    {
                        //resim 1
                        $resimDosyasi1=$request->file('resim');
                        $resim=$resimDosyasi1->getClientOriginalName();
                        $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                        //resim 2
                        $resimDosyasi2=$request->file('resim2');
                        $resim2=$resimDosyasi2->getClientOriginalName();
                        $resimDosyasi2->move(public_path("images/".$request->urunAd),$resim2);
                        Urunler::where("id",$urunID)->update([
                            "resim"=>$resim,
                            "resim2"=>$resim2,
                            "urunAd"=>$request->urunAd,
                            "urunFiyat"=>$request->urunFiyat,
                        ]);
                        return redirect()->back()->with("basarili","Ürün güncelleme başarılı ürün ile ilgili 1. ve 2. fotoğrafı güncellediniz.");
                    }
                   
                    
                }
                else
                { 
                    //resim 1
                    $resimDosyasi1=$request->file('resim');
                    $resim=$resimDosyasi1->getClientOriginalName();
                    $resimDosyasi1->move(public_path("images/".$request->urunAd),$resim);
                    Urunler::where("id",$urunID)->update([
                        "resim"=>$resim,
                        "urunAd"=>$request->urunAd,
                        "urunFiyat"=>$request->urunFiyat,
                    ]);
                     return redirect()->back()->with("basarili","Ürün güncelleme başarılı ürün ile ilgili 1. fotoğrafı güncellediniz.");
    
                }
                
            }
            else
            {
                
                 return redirect()->back()->with("hata","Ürün ekleme başarısız 1. resim alanını doldurmanız zorunludur");
            }
        }
        else
        {
            return redirect()->back()->with("hata","Ürün ile ilgili gerekli bilgileri doldurunuz !!");
        }
    }

    function duzenleBirim($birimID)
    {
        $birimBilgi=Birimler::where("id",$birimID)->first();
        return view("duzenleBirim",compact('birimBilgi'));
    }
    function duzenleBirimPost(Request $request,$birimID)
    {
        if(!empty($request->adsoyad) && !empty($request->resim) && !empty($request->meslekiGorev) && !empty($request->instagram) && !empty($request->twitter) && !empty($request->facebook))
        {
            $resimDosyasi=$request->file('resim');
            $resim=$resimDosyasi->getClientOriginalName();
            $birimSeflink=Str::of($request->adsoyad)->slug('');
            $resimDosyasi->move(public_path("images/".$birimSeflink),$resim);

            Birimler::where("id",$birimID)->update([
                "resim"=>$resim,
                "adsoyad"=>$request->adsoyad,
                "seflink"=>$birimSeflink,
                "meslekiGorev"=>$request->meslekiGorev,
                "instagram"=>$request->instagram,
                "twitter"=>$request->twitter,
                "facebook"=>$request->facebook
            ]);
            return redirect()->back()->with("basarili","Birim güncellendi..");
        }
        else
        {
            return redirect()->back()->with("hata","Birim güncellenemedi lütfen boş alan bırakmayınız...");
        }
    }
    function kaldir($urunID)
    {
        $urunBilgi=Urunler::where("id",$urunID)->first();

        Urunler::where("id",$urunID)->delete();
        return redirect()->back()->with("basarili","Ürünü kaldırma işlemi başarılı");
    }
    function kaldirBirim($birimID)
    {
        $birimBilgi=Birimler::where("id",$birimID)->first();

        Birimler::where("id",$birimID)->delete();
        return redirect()->back()->with("basarili","Birim kaldırma işlemi başarılı");
    }
    function gelenKutusu()
    {
        $mesajlar=Iletisim::where("durum",1)->get();
        return view("gelenKutusu",compact('mesajlar'));
    }

    // GİRİŞ YAPMAYAN
    function birimlerGY()
    {
        $birimler=Birimler::where("durum",1)->get();
        return view("birimlerGY",compact('birimler'));
    }
    function iletisimGY()
    {
        return view("iletisimGY");
    }
    function iletisimGYPost(Request $request)
    {
        if(!empty($request->email) && !empty($request->baslik) && !empty($request->mesaj))
        {
            Iletisim::create([
                "email"=>$request->email,
                "baslik"=>$request->baslik,
                "mesaj"=>$request->mesaj
            ]);
            return redirect()->route('iletisimGY')->with("basarili","Mesajınız alınmıştır en kısa sürede dönüş sağlayacağız.");
        }
        else
        {
            return redirect()->back()->with("hata","Boş alan bırakmayınız");
        }
    }

    
}
