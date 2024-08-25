<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $merchants = Merchant::where('id', '!=', 0);
        if (isset($search) && !empty($search)) {
            $merchants->where('nama_merchant', 'like', '%' . $search . '%');
        }

        $merchants = $merchants->paginate(10);
        return view('admin.merchant.index',[
            'merchants' => $merchants,
            'search' => $search
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
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function show(Merchant $merchant)
    {
        return view('admin.merchant.show',[
            'merchant' => $merchant
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit(Merchant $merchant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merchant $merchant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merchant  $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merchant $merchant)
    {
        Merchant::destroy($merchant->id);
        return response()->json([
            'message' => 'Berhasil Menghapus Data Merchant !'
        ]);
    }

    public function changeStatus($id){
        $merchant = Merchant::find($id);
        if ($merchant->isConfirm == 1) {
            $merchant->isConfirm = 0;
            $merchant->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Merchant Menjadi NonAktif!']);
        }else{
            $merchant->isConfirm = 1;
            $merchant->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Merchant Menjadi Aktif!']);
        }
    }
}
