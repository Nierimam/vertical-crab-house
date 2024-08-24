<?php

namespace App\Http\Controllers;

use App\Models\vouchers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VouchersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $vouchers = vouchers::where('id', '!=', 0);
        if (isset($search) && !empty($search)) {
            $vouchers->where('nama', 'like', '%' . $search . '%');
        }

        $vouchers = $vouchers->paginate(10);
        return view('admin.voucher.index',[
            'vouchers' => $vouchers,
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
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'type' => 'required',
            'berlaku_sampai' => 'required',
            'jumlah' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $voucher = new vouchers();
            $voucher->nama = $request->nama;
            $voucher->type = $request->type;
            $voucher->berlaku_sampai = date($request->berlaku_sampai);
            if ($request->type == 'persentase') {
                $voucher->persentase = $request->persentase;
                $voucher->nominal = 0;
            }else{
                $voucher->nominal = $request->nominal;
                $voucher->persentase = 0;
            }
            $voucher->jumlah = $request->jumlah;
            $voucher->deskripsi = $request->deskripsi;
            if ($request->gambar_voucher) {
                $gambar = $this->uploadGambar($request->gambar_voucher);
                $voucher->gambar_voucher = $gambar;
            }
            $voucher->save();

            DB::commit();
            session()->flash('success','Berhasil Menambahkan data Voucher');
            return redirect()->route('voucher.index');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('warning','Gagal menambahkan data voucher');
            return redirect()->route('voucher.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vouchers  $vouchers
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = vouchers::find($id);
        return view('admin.voucher.show',[
            'voucher' => $voucher
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vouchers  $vouchers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vouchers = vouchers::find($id);
        return view('admin.voucher.edit',[
            'voucher' => $vouchers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vouchers  $vouchers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'type' => 'required',
            'berlaku_sampai' => 'required',
            'persentase' => 'required',
            'nominal' => 'required',
            'jumlah' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $vouchers = vouchers::find($id);
            $vouchers->nama = $request->nama;
            $vouchers->type = $request->type;
            $vouchers->berlaku_sampai = date($request->berlaku_sampai);
            if ($request->type == 'persentase') {
                $vouchers->persentase = $request->persentase;
                $vouchers->nominal = 0;
            }else{
                $vouchers->nominal = $request->nominal;
                $vouchers->persentase = 0;
            }
            $vouchers->jumlah = $request->jumlah;
            $vouchers->deskripsi = $request->deskripsi;
            if ($request->gambar_voucher) {
                $gambar = $this->uploadGambar($request->gambar_voucher);
                $vouchers->gambar_voucher = $gambar;
            }
            $vouchers->save();

            DB::commit();
            session()->flash('success','Berhasil Mengubah data Voucher');
            return redirect()->route('voucher.index');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('warning','Gagal mengubah data voucher');
            return redirect()->route('voucher.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vouchers  $vouchers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        vouchers::destroy($id);
        return response()->json([
            'message' => 'Berhasil menghapus data voucher'
        ]);
    }
}
