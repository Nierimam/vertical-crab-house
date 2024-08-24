<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\orders;
use App\Models\produks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    protected $database;
    public function __construct()
    {
        $this->database = app('firebase.database');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $referenceHistory = $this->database->getReference('/history');
        $snapshotHistory = $referenceHistory->getSnapshot();
        $dataHistory = $snapshotHistory->getValue();

        $referenceRealtime = $this->database->getReference('/realtime');
        $snapshotRealtime = $referenceRealtime->getSnapshot();
        $dataRealtime = $snapshotRealtime->getValue();

        $no = 0;
        $result = [
            'dissolved_oxygen' => [],
            'nitrite' => [],
            'ph' => [],
            'salinity' => [],
            'temperature' => [],
            'total_ammonia_nitrogen' => [],
            'unionized_ammonia' => [],
            'datetime' => [],
        ];

        foreach (array_reverse($dataHistory, true) as $key => $value) {
            if ($no < 5) {
                    $result['dissolved_oxygen'][] = $value['dissolved_oxygen'];
                    $result['nitrite'][] = $value['nitrite'];
                    $result['ph'][] = $value['ph'];
                    $result['salinity'][] = $value['salinity'];
                    $result['temperature'][] = $value['temperature'];
                    $result['total_ammonia_nitrogen'][] = $value['total_ammonia_nitrogen'];
                    $result['unionized_ammonia'][] = $value['unionized_ammonia'];
                    $result['datetime'][] = $value['Date'] . ' ' . $value['Time'];
                $no++;
            }
        }





        $produk     = produks::all();
        $customer   = customers::all();
        $semua_order = orders::orderBy('id', 'DESC');
        $month = $request->month ?? '';

        if (auth()->user()->role == 'admin') {
            $type = $request->type;
            $semua_order = $semua_order->whereHas('order_produks', function ($query) use ($type) {
                $query->whereHas('produk_variants', function ($query2) use ($type) {
                    $query2->whereHas('produks', function ($query3) use ($type) {
                        if ($type == 'farmer') {
                            $query3->whereNotNull('farmer_id');
                        } else {
                            $query3->whereNotNull('merchant_id');
                        }
                    });
                });
            });
        } else {
            $user = auth()->user();
            $semua_order = $semua_order->whereHas('order_produks', function ($query) use ($user) {
                $query->whereHas('produk_variants', function ($query2) use ($user) {
                    $query2->whereHas('produks', function ($query3) use ($user) {
                        if ($user->role == 'farmer') {
                            $query3->where('farmer_id', $user->farmer->id);
                        } else {
                            $query3->where('merchant_id', $user->merchant->id);
                        }
                    });
                });
            });
        }

        $total_pemesanan = $semua_order->sum('total');
        $order = $semua_order->limit(5)->get();

        return view('admin.dashboard',[
            'produk' => count($produk),
            'customer' => $customer,
            'order' => $order,
            'month' => $month,
            'total_pemesanan' => $total_pemesanan,
            'dataRealtime' => $dataRealtime,
            'result' => json_encode($result),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    function getPenjualan() {
        $order = orders::all();
        $done = orders::where('status','diterima')->get();
        $batal = orders::where('status','dibatalkan')->get();
        $belum_terbayar = orders::whereIn('status',['pending', 'menunggu_pembayaran', 'menunggu_persetujuan'])->get();
        $terbayar = orders::whereIn('status',['terbayar', 'pengiriman'])->get();
        $persentase_done = (count($done) / count($order)) * 100;
        $persentase_belum_terbayar = (count($belum_terbayar) / count($order)) * 100;
        $persentase_terbayar = (count($terbayar) / count($order)) * 100;
        $persentase_batal = (count($batal) / count($order)) * 100;


        return response()->json([
            'persentase_done' => $persentase_done,
            'persentase_belum_terbayar' => $persentase_belum_terbayar,
            'persentase_terbayar' => $persentase_terbayar,
            'persentase_batal' => $persentase_batal,
            'count_done' => count($done),
            'count_belum_terbayar' => count($belum_terbayar),
            'count_terbayar' => count($terbayar),
            'count_batal' => count($batal),
        ]);
    }

    function getPenjualanBulan(Request $request) {
        $month = $request->month ?? '';
        $orders = orders::whereIn('status', ['terbayar', 'pengiriman', 'diterima']);

        if (!empty($month)) {
            $orders = $orders->whereMonth('created_at', str_pad($month, 2, '0', STR_PAD_LEFT));
        }

        $orders = $orders->get();

        $data = [];
        foreach ($orders as $key => $value) {
            $data[date('Y-m-d', strtotime($value->created_at))][] = $value;
        }

        $result = [];
        foreach ($data as $key => $value) {
            $result[] = count($value);
        }

        return response()->json($result);
    }
}
