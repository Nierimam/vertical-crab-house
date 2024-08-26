<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = orders::where('id','!=',0)
        ->orderBy('created_at','desc');
        if (auth()->user()->role == 'admin') {
            $type = $request->type;
            $data = $data->whereHas('order_produks', function ($query) use ($type) {
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
            $data = $data->whereHas('order_produks', function ($query) use ($user) {
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
        if (isset($search) && !empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('invoice', 'like', '%' . $search . '%')
                    ->orWhere('no_resi', 'like','%' . $search . '%')
                    ->orWhereHas('customers', function ($query2) use ($search){
                        $query2->where('nama_lengkap', 'like', '%' . $search . '%');
                    });
            });
        }
        if (isset($request->month) && $request->month != 'all') {
            $data = $data->whereMonth('created_at',$request->month);
         }

         if (isset($request->year) && $request->year != 'all') {
            $data = $data->whereYear('created_at', $request->year);
        }
        $total_pemesanan = $data;
        $data = $data->paginate(10);
        return view('admin.order.index',[
            'data' => $data,
            'search' => $search,
            'select_month' => $request->month,
            'select_year' => $request->year,
            'total_pemesanan' => $total_pemesanan->where('status','diterima')->sum('total')
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
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders, $id)
    {
        $data = orders::find($id);
        return view('admin.order.show',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders, $id)
    {
        $data = orders::find($id);
        return view('admin.order.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = Validator::make( $request->all(),[
            'shipping_driver' => 'required',
            'shipping_price' => 'required'
        ],[
            'shipping_driver.required' => 'Silahkan Pilih Kurir Pengiriman Dahulu',
            'shipping_price.required' => 'Masukkan Harga Pengiriman Dahulu',
        ]);

        if (!$validasi->fails()) {
            $orders = orders::find($id);
            $total = $orders->total + $this->numberFormat($request->shipping_price);
            $orders->total = $total;
            $orders->shipping_courier = $request->shipping_driver;
            $orders->shipping_price = $this->numberFormat($request->shipping_price);
            $orders->status = 'menunggu_pembayaran';
            $orders->save();
            session()->flash('success','Berhasil Konfirmasi Pesanan');
            return redirect()->route('order.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('order.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }

    public function page_confirm_payment(orders $orders, $id)
    {
        $data = orders::find($id);
        return view('admin.order.confirm_payment',[
            'data' => $data
        ]);
    }

    public function confirm_payment(Request $request,$id)
    {
        $validasi = Validator::make( $request->all(),[
            'status' => 'required',
        ],[
            'status.required' => 'Silahkan Pilih Persetujuan Pembayaran Dahulu',
        ]);

        if (!$validasi->fails()) {
            $orders = orders::find($id);
            $orders->status = $request->status;
            $orders->save();
            session()->flash('success','Berhasil Konfirmasi Pembayaran');
            return redirect()->route('order.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('order.edit', $id);
        }

    }

    public function confirm_order($id)
    {
        $order = orders::find($id);
        $order->status = 'menunggu_pembayaran';
        $order->save();
        session()->flash('success','Berhasil Konfirmasi Pemesanan');
        return redirect()->route('order.index');
    }

    public function page_confirm_pengiriman(orders $orders, $id)
    {
        $data = orders::find($id);
        return view('admin.order.confirm_pengiriman',[
            'data' => $data
        ]);
    }

    public function confirm_pengiriman(Request $request,$id)
    {
        $validasi = Validator::make( $request->all(),[
            'no_resi' => 'required',
        ],[
            'no_resi.required' => 'Silahkan Masukkan No Resi',
        ]);

        if (!$validasi->fails()) {
            $orders = orders::find($id);
            $orders->no_resi = $request->no_resi;
            $orders->status = 'pengiriman';
            $orders->save();
            session()->flash('success','Berhasil Kirim Pesanan');
            return redirect()->route('order.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->withInput()->back();
        }
    }

    public function export(Request $request)
    {
        $search = $request->search;
        $data = orders::where('id','!=',0)
        ->where('status','diterima')
        ->orderBy('created_at','desc');
        if (auth()->user()->role == 'admin') {
            $type = $request->type;
            $data = $data->whereHas('order_produks', function ($query) use ($type) {
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
            $data = $data->whereHas('order_produks', function ($query) use ($user) {
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
        if (isset($search) && !empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('invoice', 'like', '%' . $search . '%')
                    ->orWhere('no_resi', 'like','%' . $search . '%')
                    ->orWhereHas('customers', function ($query2) use ($search){
                        $query2->where('nama_lengkap', 'like', '%' . $search . '%');
                    });
            });
        }
        if (isset($request->month) && $request->month != 'all') {
            $data = $data->whereMonth('created_at',$request->month);
         }

         if (isset($request->year) && $request->year != 'all') {
            $data = $data->whereYear('created_at', $request->year);
        }
        $data = $data->get();
        $year = $request->year;
        $month = $request->month;
         return Excel::download(new OrderExport($data, $year, $month), 'order-export.xlsx');
    }


}
