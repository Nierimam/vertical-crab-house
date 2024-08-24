<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    private $enabled_payment = ['gopay','bca_va', 'bri_va', 'bni_va'];

    function create(Request $request) {
        
        $order = orders::find($request->id);
        if ($order != null) {
            $auth = base64_encode(env('MIDTRANS_SERVER_KEY').':');
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $transaction_id = $order->invoice;
            
            try {
                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction_id,
                        'gross_amount' => (float) $order->total,
                    ],
                    'customer_details' => [
                        'first_name' => 'Customer',
                        'last_name' => $order->customers->nama_lengkap,
                        'email' => $order->customers->user->email,
                        'phone' => $order->customers->no_telp,
                    ],
                    'enabled_payments' => $this->enabled_payment
                ];

                // dd($params);
        
                $response_midtrans = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic '.$auth
                ])->post($url, $params);
                
                $data = json_decode($response_midtrans->body());
                $order->token_midtrans = $data->token;
                $order->checkout_url = $data->redirect_url;
                $order->save();

    
                $response = [
                    'error' => false,
                    'data' => $data,
                    'message' => 'Berhasil membuat transaksi'
                ];
            } catch (\Exeption $e) {
                $response = [
                    'error' => true,
                    'message' => 'Terjadi kesalahan dalam membuat transaksi'
                ];
            }
        } else {
            $response = [
                'error' => true,
                'message' => 'Data Pembayaran tidak ditemukan'
            ];
        }


        return response()->json($response);
    }

    function webhook(Request $request) {

        try {
            $data = json_decode(file_get_contents('php://input'), true);
            Log::debug(json_encode($data));
            $orders = orders::where('invoice', $data['order_id'])->first();
            $orders->status = $data['transaction_status'];
            $orders->pesan = $data['status_message'];
            if ($data['payment_type'] == 'gopay' || $data['payment_type'] == 'qris') {
                $orders->no_bank = 'gopay';
                $orders->nama_bank = 'gopay';
            } else {
                $orders->no_bank = $data['va_numbers'][0]['va_number'];
                $orders->nama_bank = $data['va_numbers'][0]['bank'];
            }
            $orders->save();

            if ($data['transaction_status'] == 'settlement') {
                $orders->status = 'terbayar';
                $orders->save();

            }

            $response = [
                'error' => false,
                'data' => $data,
                'message' => 'Berhasil melihat transaksi'
            ];
        } catch (\Exeption $e) {
            $response = [
                'error' => true,
                'message' => 'Terjadi kesalahan dalam melihat transaksi'
            ];
        }
    }
}
