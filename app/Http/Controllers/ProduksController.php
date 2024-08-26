<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\produk_variants;
use App\Models\produks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProduksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if (auth()->user()->role == 'admin') {
            $produk = produks::where('id','!=',0)->orderBy('created_at','desc');
        }elseif(auth()->user()->role == 'merchant'){
            $produk = produks::where('merchant_id',auth()->user()->merchant->id)
            ->orderBy('created_at','desc');
        }elseif(auth()->user()->role == 'farmer'){
            $produk = produks::where('farmer_id',auth()->user()->farmer->id)
            ->orderBy('created_at','desc');
        }
        if (isset($search) && !empty($search)) {
            $produk->where(function ($query) use ($search) {
                $query->where('nama_produk', 'like', '%' . $search . '%');
            });
        }
        $produk = $produk->paginate(10);
        return view('admin.produk.index',[
            'produks' => $produk,
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
        if (auth()->user()->role == 'merchant') {
            $data = categories::where('type','merchant')->get();
        }elseif(auth()->user()->role == 'farmer'){
            $data = categories::where('type','farmer')->get();
        }
        return view('admin.produk.create',[
            'kategori' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make( $request->all(),[
            'category_id' => 'required|integer',
            'nama_produk' => 'required|string|max:100',
            'slug' => 'required|string',
            'deskripsi' => 'required',
            'keyword' => 'required',
            'price' => 'required',
            'status' => 'required',
            'nama_variant' => 'required|max:100',
            'stok' => 'required',
            'img.*' => 'required|mimes:jpg,png,webp,svg,jpeg,gif'
        ],[
            'nama_produk.max' => 'Judul Maximal 100 Karakter',
            'nama_variant.max' => 'Judul Maximal 100 Karakter',
            'img.*.mimes' => 'Format Gambar harus: jpg,png,webp,svg,jpeg,gif',
            'keyword.required' => 'Keyword Harus Diisi'
        ]);

        if (!$validasi->fails()) {
            $produk = new produks();
            $produk->category_id = $request->category_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->slug = $request->slug;
            $produk->deskripsi = $request->deskripsi;
            $produk->keyword = $request->keyword;
            $produk->status = $request->status;
            if (auth()->user()->role == 'merchant') {
                $produk->merchant_id = auth()->user()->merchant->id;
                $produk->type = 'merchant';
            }elseif(auth()->user()->role == 'farmer'){
                $produk->farmer_id = auth()->user()->farmer->id;
                $produk->type = 'farmer';
            }
            $produk->isConfirm = true;
            $produk->viewed = 0;
            $produk->rated = 0;
            $produk->save();

            foreach ($request->img as $key => $value) {
                $variants = new produk_variants();
                $gambar = $this->uploadGambar($value);
                $variants->produk_id = $produk->id;
                $variants->nama_variant = $request->nama_variant[$key];
                $variants->price = $this->numberFormat($request->price[$key]);
                $variants->berat = $request->berat[$key];
                $variants->stok = $request->stok[$key];
                $variants->img = $gambar;
                $variants->save();

            }
            session()->flash('success','Berhasil Menambah Produk');
            return redirect()->route('product.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('product.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $variants = produk_variants::where('produk_id', $id)->get();
        $produk = produks::where('id', $id)->first();
        return view('admin.produk.show',[
            'data' => $produk,
            'variant' => $variants
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = produks::where('id', $id)->first();
        $variants = produk_variants::where('produk_id', $id)->get();
        $kategori = categories::all();
        return view('admin.produk.edit',[
            'data' => $produk,
            'kategori' => $kategori,
            'variant' => $variants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = Validator::make( $request->all(),[
            'category_id' => 'required|integer',
            'nama_produk' => 'required|string|max:100',
            'slug' => 'required|string',
            'deskripsi' => 'required',
            'keyword' => 'required',
            'status' => 'required',
            'nama_variant.*' => 'required|max:100',
            'stok.*' => 'required',
            'img.*' => 'mimes:jpg,png,webp,svg,jpeg,gif'
        ],[
            'nama_produk.max' => 'Judul Maximal 100 Karakter',
            'nama_variant.*.max' => 'Judul Maximal 100 Karakter',
            'img.*.mimes' => 'Format Gambar harus: jpg,png,webp,svg,jpeg,gif',
            'keyword.required' => 'Keyword Harus Diisi'
        ]);

        if (!$validasi->fails()) {
            $stok_variant_edit = $request->stok_variant_edit;
            if (isset($request->gambar_blog_delete) && !empty($request->gambar_blog_delete)) {
                $gambar_hidden = explode(',', $request->gambar_blog_delete);
                if (count($gambar_hidden) > 0) {
                    foreach ($gambar_hidden as $key => $value) {
                        $gambar = produk_variants::find($value);
                        if ($gambar != null) {
                            $gambar->delete();
                            if (isset($request->stok_variant_edit) && !empty($request->stok_variant_edit)) {
                                $temp_stok_variant = explode(',', $request->stok_variant_edit);
                                if (in_array($value, $temp_stok_variant)) {
                                    $temp_id_update = '';
                                    foreach ($temp_stok_variant as $k => $v) {
                                        if ($v != $value) {
                                            if ($temp_id_update != '') {
                                                $temp_id_update .= ',';
                                            }
                                            $temp_id_update = $v;
                                        }
                                    }
                                    $stok_variant_edit = $temp_id_update;
                                }
                            }
                        }
                    }
                }
            }

            if (isset($request->gambar_blog_edit) && !empty($request->gambar_blog_edit)) {
                $gambar_edit = explode(',', $request->gambar_blog_edit);
                if (count($gambar_edit) > 0) {
                    sort($gambar_edit);
                    foreach ($gambar_edit as $key => $value) {
                        $gambar_update = array_values($request->img_update);
                        $gambar = produk_variants::find($value);
                        $gambarUpload = $this->uploadGambar($gambar_update[$key]);
                        $gambar->img = $gambarUpload;
                        $gambar->save();
                    }
                }
            }
            $produk = produks::find($id);
            $produk->category_id = $request->category_id;
            $produk->nama_produk = $request->nama_produk;
            $produk->slug = $request->slug;
            $produk->deskripsi = $request->deskripsi;
            $produk->keyword = $request->keyword;
            $produk->status = $request->status;
            $produk->viewed = 0;
            $produk->rated = 0;
            $produk->save();

            if (isset($stok_variant_edit) && !empty($stok_variant_edit)) {
                foreach (explode(',', $stok_variant_edit) as $key => $value) {
                    $produk_variant = produk_variants::find($value);
                    $produk_variant->stok = $request->stok_update[$key];
                    $produk_variant->price = $request->price_update[$key];
                    $produk_variant->berat = $request->berat_update[$key];
                    $produk_variant->nama_variant = $request->nama_variant_update[$key];
                    $produk_variant->save();
                }
            }

            if (isset($request->img)) {
                foreach ($request->img as $key => $value) {
                    $new_variant = new produk_variants();
                    $new_variant->produk_id = $produk->id;
                    $new_variant->nama_variant = $request->nama_variant[$key];
                    $new_variant->stok = $request->stok[$key];
                    $new_variant->price = $request->price[$key];
                    $new_variant->berat = $request->berat[$key];
                    $gambarUpdate = $this->uploadGambar($value);
                    $new_variant->img = $gambarUpdate;
                    $new_variant->save();
                }
            }

            session()->flash('success','Berhasil Edit produk');
            return redirect()->route('product.index');
        }else{
            // dd($validasi->errors());
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('product.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produks  $produks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        produks::destroy($id);
        return response()->json([
            'message' => 'Data Produk Berhasil Dihapus'
        ]);
    }


    public function updateStatusProduct($id){

        $product = produks::find($id);
        if ($product->isConfirm == 1) {
            $product->isConfirm = 0;
            $product->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Produk Menjadi NonAktif!']);
        }else{
            $product->isConfirm = 1;
            $product->save();
            return response()->json(['message' => 'Berhasil Mengubah Status Produk Menjadi Aktif!']);
        }
    }

}
