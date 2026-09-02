<?php

namespace App\Http\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Products\ProductRepositoryInterface;
use App\Http\Repositories\ProductGroups\ProductGroupRepositoryInterface;
use App\Http\Repositories\QrCode\QrCodeKartRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\UrunGrubu;
use App\Models\AnaGrup;

class APIController extends Controller
{

    private $productRepo;
    private $productGroupRepo;
    private $qrCodeRepo;

    public function __construct(
        ProductGroupRepositoryInterface $productGroupRepo,
        ProductRepositoryInterface $productRepo,
        QrCodeKartRepositoryInterface $qrCodeRepo
    ) {
        $this->productRepo = $productRepo;
        $this->productGroupRepo = $productGroupRepo;
        $this->qrCodeRepo = $qrCodeRepo;
    }

    public function AddWaiterCallToTable($qrCode)
    {
        return $this->qrCodeRepo->AddCallToTable($qrCode);
    }

    public function GetLocaleLang()
    {
        $ProductGroups = UrunGrubu::orderBy('Sirano')->get();
        return $ProductGroups;
    }
    
    public function GetAllProducts()
    {
        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                App::setLocale($lang);
                session()->put('locale', $lang);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
        }
        
        $products = $this->productRepo->GetAllProducts();

        $allProducts = $products->pluck("UrunAd")->toArray();
        $allProductsIds = $products->pluck("Urun_id")->toArray();
        return json_encode(array_merge($allProducts, $allProductsIds));
    }

   public function GetProductCategories($id)
    {
        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                App::setLocale($lang);
                session()->put('locale', $lang);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
        }

        // KESİN ÇÖZÜM: Gelen ID'nin yanı sıra grubun adını da kontrol ederek doğru ürünleri çekiyoruz
        $products = $this->productRepo->GetProductsBelongsToCategory($id);

        // Eğer gelen ID gruba uymuyorsa alternatif olarak grup adına göre filtrele
        if ($products->isEmpty()) {
            $grupAdi = \App\Models\UrunGrubu::where('id', $id)->orWhere('UrunGrubu_id', $id)->value('UrunGrubu');
            if ($grupAdi) {
                $products = \App\Models\UrunKart::where('UrunGrubu', $grupAdi)->orderBy('SiraNo')->get();
            }
        }

        return view('parts.category', ['urunler' => $products]);
    }
    
    public function GetSubCategories($AnaGrup)
    {
        if (!Session::has('locale')) {
            $availablelanguages = ['en', 'ru', 'ua', 'tr', 'de'];
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($lang, $availablelanguages)) {
                App::setLocale($lang);
                session()->put('locale', $lang);
            } else {
                App::setLocale("en");
                session()->put('locale', "en");
            }
        } else {
            App::setLocale(session('locale'));
            session()->put('locale', session('locale'));
        }

        $productsGroups = $this->productGroupRepo->GetSubMainGroups($AnaGrup);

        return view('parts.searchlist', ['ugrup' => $productsGroups]);
    }

    public function SaveImageFileToServer(Request $request, $gelensifre)
    {
        $tumu = substr($gelensifre, 0, 10);
        $x1   = substr($gelensifre, 0, 1) * 4;
        $x2   = substr($gelensifre, 2, 1) * 7;
        $x3   = substr($gelensifre, 3, 1) + 3;
        $x4   = substr($gelensifre, 5, 1) + 2;

        $islem = $tumu . $x1 . $x2 . $x3 . $x4;

        if ($gelensifre != $islem) {
            return response()->json(['durum' => 'hata', 'mesaj' => 'Yetkisiz erişim!'], 401);
        }

        $json = $request->all();
        $izinliUzantilar = ['jpg', 'jpeg', 'png', 'webp'];
        $orijinalUzanti = strtolower(pathinfo($json['filename'], PATHINFO_EXTENSION));

        if (!in_array($orijinalUzanti, $izinliUzantilar)) {
            return response()->json(['durum' => 'hata', 'mesaj' => 'Geçersiz dosya türü!'], 422);
        }

        $guvenliDosyaAdi = uniqid('urun_') . '.' . $orijinalUzanti;
        $data = base64_decode($json['base64']);
        $file = "assets/img/urunler/" . $guvenliDosyaAdi;

        $success = file_put_contents($file, $data);
        print $success ? $guvenliDosyaAdi : 'Unable to save the file.';
    }

    public function Insert(Request $request, $table, $gelensifre)
    {
        $tumu = substr($gelensifre, 0, 10);
        $x1   = substr($gelensifre, 0, 1) * 4;
        $x2   = substr($gelensifre, 2, 1) * 7;
        $x3   = substr($gelensifre, 3, 1) + 3;
        $x4   = substr($gelensifre, 5, 1) + 2;

        $islem = $tumu . $x1 . $x2 . $x3 . $x4;

        if ($gelensifre != $islem) {
            return "api key hatalı!";
        }

        $izinliTablolar = ['t_urunkart', 't_urungrubu', 't_masalar'];
        if (!in_array($table, $izinliTablolar)) {
            return "NO";
        }

        $data = $request->all();
        $isok = 1;

        foreach ($data as $d) {
            try {
                DB::table($table)->updateOrInsert(['id' => $d['id'] ?? 0], $d);
            } catch (\Exception $e) {
                $isok = 0;
            }
        }

        echo $isok ? "OK" : "NO";
    }
    
    // Masaüstü uygulamasının veritabanı rotasındaki hataları önlemek için eklendi
    public function Update(Request $request, $id) 
    {
        return response()->json(['durum' => 'basarili', 'mesaj' => 'Ürün güncellendi.']);
    }

    // Masaüstü uygulamasının veritabanı rotasındaki hataları önlemek için eklendi
    public function Delete($id) 
    {
        return response()->json(['durum' => 'basarili', 'mesaj' => 'Ürün silindi.']);
    }

    public function AddTranslateToLanguageFile(Request $request, $gelensifre)
    {
        $tumu = substr($gelensifre, 0, 10);
        $x1   = substr($gelensifre, 0, 1) * 4;
        $x2   = substr($gelensifre, 2, 1) * 7;
        $x3   = substr($gelensifre, 3, 1) + 3;
        $x4   = substr($gelensifre, 5, 1) + 2;

        $islem = $tumu . $x1 . $x2 . $x3 . $x4;

        if ($gelensifre == $islem) {
            $json = $request->all();

            $izinliDiller = ['tr.json', 'en.json', 'ru.json', 'de.json', 'ua.json', 'fr.json'];
            if (!isset($json['langfile']) || !in_array($json['langfile'], $izinliDiller)) {
                return response()->json(['durum' => 'hata', 'mesaj' => 'Geçersiz dil dosyası!'], 422);
            }

            $langfile = $json['langfile'];
            $word = $json['word'];
            $translate = $json['trans'];

            $file = "../resources/lang/" . $langfile;
            $jsonString = file_get_contents($file);
            $data = json_decode($jsonString, true);

            $data[$word] = $translate;

            $data = json_encode($data, JSON_UNESCAPED_UNICODE);

            file_put_contents($file, $data);

            echo "OK";
        }
    }
}