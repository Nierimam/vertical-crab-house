<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function sendNotifTelegram($message)
    {
        // $chat_id = 0;
        // $message = urlencode($message);
        // $url = "https://api.telegram.org/bot6772732837:AAGdhkfXNDutRS4eYFR-ueV0HZ6aPagsSxc/sendMessage?chat_id=-4031351457&text=$message&parse_mode=HTML";

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        // ));
        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);

        // return $response;
    }

    public function formatNumberHp($no){
        $no_awal = $no;
        if(substr($no_awal,0, 1) == '0'){
            $no_cek = substr($no_awal,1, strlen($no_awal));
        } else if (substr($no_awal,0, 1) == '+') {
            $no_cek = substr($no_awal,1, strlen($no_awal));
        } else {
            $no_cek = $no_awal;
        }

        if(substr($no_cek,0, 2) == '62') {
            $no_final = $no_cek;
        } else {
            $no_final = '62'.$no_cek;
        }

        return $no_final;
    }

    public function uploadGambar($file)
    {
        $imgName = '';
        $extension  = $file->getClientOriginalExtension();
        if (in_array($extension, ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx'])) {
            $imgName = rand(0, 999) . now()->timestamp . '.' . $extension;
            $file->move('upload', $imgName);
        }
        return $imgName;
    }

    public function numberFormat($format)
    {
        $formatNumber = str_replace('.', '', $format);

        return $formatNumber;
    }

    public function generateInvoice() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $invoice = 'VRTCH/'.str_pad(date('m'), 2, '0', STR_PAD_LEFT).'/'.date('Y').'/'.$randomString;
        return $invoice;
    }

    function getProvinsiRajaOngkir($id = null) {
        $curl = curl_init();
        $param = '';
        if ($id != null) {
            $param = '?id='.$id;
        }
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province".$param,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".getenv('RAJAONGKIR_KEY')
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        return json_decode($response, true);
    }

    function getCityRajaOngkir($provinsi, $id = null) {
        $curl = curl_init();
        $param = '';
        if ($id != null) {
            $param = '&id='.$id;
        }
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$provinsi.$id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: ".getenv('RAJAONGKIR_KEY')
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    function getCostRajaOngkir($origin, $destination, $weight, $courier) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".getenv('RAJAONGKIR_KEY')
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
}
