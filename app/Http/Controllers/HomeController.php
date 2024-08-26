<?php

namespace App\Http\Controllers;

use App\Models\blogs;
use App\Models\carts;
use App\Models\company;
use App\Models\customers;
use App\Models\customer_address;
use App\Models\Farmer;
use App\Models\JasaPengiriman;
use App\Models\Merchant;
use App\Models\produk_variants;
use App\Models\produks;
use App\Models\vouchers;
use App\Models\orders;
use App\Models\order_produks;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $produks = produks::all();
        $tanggal_sekarang = date('Y-m-d');
        $vouchers = vouchers::where('berlaku_sampai','>=',$tanggal_sekarang)->get();
        $blogs = blogs::limit(3)->get();
        return view('user.home',[
            'produks' => $produks,
            'vouchers' => $vouchers,
            'blogs' => $blogs
        ]);
    }

    public function detailProduk($id,$slug){
        $produk = produks::where('id',$id)->where('slug',$slug)->firstOrFail();
        $produk_ratings = order_produks::whereHas('produk_variants', function ($query) use ($produk) {
            $query->where('produk_id', $produk->id);
        })->where('rating', '>', 0)->get();
        return view('user.shop.show',[
            'produk' => $produk,
            'produk_ratings' => $produk_ratings
        ]);
    }

    public function profileUser(Request $request){
        $orders = orders::with('order_produks')->where('customer_id',auth()->user()->customers->id)->get();
        return view('user.profile.index',[
            'orders' => $orders,
            'tab' => isset($request->tab) ? $request->tab : 'v-pills-profile'
        ]);
    }

    public function listOrderUser(){
        $orders = orders::with('order_produks')->where('customer_id',auth()->user()->customers->id)->get();
        return view('user.profile.list-order',[
            'orders' => $orders
        ]);
    }

    public function orderDetailUser($id){
        $order = orders::find($id);
        return view('user.profile.detail-order',[
            'order' => $order,
        ]);
    }

    public function konfirmasiOrder(Request $request,$id){
        try {
            DB::beginTransaction();
            $order = orders::find($id);
            if (isset($request->batal_pesanan)) {
                $order->status = 'dibatalkan';
                $order->save();
                session()->flash('success','Berhasil Membatalkan Pesanan');
                DB::commit();
                return redirect()->route('detailOrder.edit',$order->id);
            }

            if ($order->status == 'menunggu_pembayaran') {
            $order->nama_bank = $request->nama_bank;
            $order->no_bank = $request->no_bank;
            $order->pemilik_bank = $request->pemilik_bank;
                if ($request->bukti_bayar) {
                    $bukti_pembayaran = $this->uploadGambar($request->bukti_bayar);
                    $order->bukti_bayar = $bukti_pembayaran;
                }
            $order->status = 'menunggu_persetujuan';
            $order->tanggal_bayar = date('Y-m-d');
            $order->save();
            session()->flash('success','Berhasil Melakukan Pembayaran');
            }

            if ($order->status == 'diterima') {
                $order_produk = order_produks::where('order_id',$order->id)->get();
                foreach ($order_produk as $key => $produk) {
                    $produk->rating = $request->rating[$key];
                    $produk->review = $request->review[$key];
                    if (isset($request->media[$key])) {
                        $media_rating = $this->uploadGambar($request->media[$key]);
                        $produk->media = $media_rating;
                    }
                    $produk->save();
                }
                session()->flash('success','Berhasil Memberikan Rating');
            }

            if ($order->status == 'pengiriman') {
                $order->status = 'diterima';
                $order->save();
                session()->flash('success','Berhasil Menerima Pesanan');
            }
            DB::commit();

            return redirect()->route('detailOrder.edit',$order->id);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
    }

    public function ubahProfile(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'username' => 'required',
            'telp' => 'required',
            'email' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                'message' => $validasi
            ]);
        }

        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            $customers = customers::where('user_id',$user->id)->first();
            $customers->user_id = $user->id;
            $customers->nama_lengkap = $request->nama_lengkap;
            $customers->telp = $request->telp;
            $customers->tempat_lahir = $request->tempat_lahir;
            $customers->tanggal_lahir = $request->tanggal_lahir;
            if ($request->img_profile) {
                $gambar = $this->uploadGambar($request->img_profile);
                $customers->img_profile = $gambar;
            }
            $customers->save();

            DB::commit();
            session()->flash('success','Berhasil megubah data');
            return redirect()->route('profile.user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
    }

    public function ubahPasswordUser(Request $request,$id){
        try {
            DB::beginTransaction();

            $user = User::find($id);
            $password_lama_user = Hash::check($request->password_lama, $user->password);
            if (!$password_lama_user) {
                session()->flash('warning','Password lama salah');
                return redirect()->route('profile.user')->with('tab','v-pills-ubah-password');
            }
            if ($request->password != $request->password_konfirmasi) {
                session()->flash('warning','Password tidak sama');
                return redirect()->route('profile.user')->with('tab','v-pills-ubah-password');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            DB::commit();
            session()->flash('success','Berhasil megubah password');
            return redirect()->route('profile.user')->with('tab','v-pills-ubah-password');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
        }
    }

    public function shopUser(Request $request){
        $search = $request->search;
        $kategori = $request->kategori ?? '';
        $produks = produks::where('id','!=',0);
        if (isset($search) && !empty($search)) {
            $produks->where(function ($query) use ($search) {
                $query->where('nama_produk', 'like', '%' . $search . '%');
            });
        }

        if ($request->type == 'merchant') {
            $produks = $produks->where('type','merchant');
        }elseif($request->type == 'farmer'){
            $produks = $produks->where('type','farmer');
        }

        if (isset($kategori) && !empty($kategori)) {
            $produks->where('category_id', $kategori);
        }
        $produks = $produks->paginate(10);
        return view('user.shop.index',[
            'produks' => $produks,
            'search' => $search,
            'kategori' => $kategori,
        ]);
    }

    public function getCart(){
        $cart = auth()->user()->customers->carts;
        foreach ($cart as $key => $value) {
            $produk_variant = produk_variants::find($value->produk_variant_id);
            $value->produk_variant = $produk_variant;
            $value->produk_variant->produk = $produk_variant->produks;
        }

        return response()->json([
            'data' => $cart,
            'status' => 200,
            'message' => 'data cart berhasil di muat'
        ]);
    }

    public function addCart(Request $request) {
        $cek_cart = carts::where('customer_id', auth()->user()->customers->id)->where('produk_variant_id', $request->ukuran)->first();

        // cek apakah sudah ada di cart
        $cek_cart_first = carts::where('customer_id', auth()->user()->customers->id)->get();
        $cek_produk = produk_variants::where('id', $request->ukuran)->first()->produks;
        if (count($cek_cart_first) > 0) {
            $cek_cart_2 = produk_variants::where('id', $cek_cart_first[0]->produk_variant_id)->first()->produks;
            if (($cek_cart_2->merchant_id != $cek_produk->merchant_id) && ($cek_cart_2->farmer_id != $cek_produk->farmer_id)) {
                $response = [
                    'error' => true,
                    'message' => 'Harap membeli produk dari merchant yang sama'
                ];
                return response()->json($response);
            }
        }
        if ($cek_cart != null) {
            $response = [
                'error' => true,
                'message' => 'Produk dengan varian ini sudah ada di dalam keranjang'
            ];
        } else {
            // cek sekali lagi stok product varian tersebut
            $produk_variant = produk_variants::find($request->ukuran);
            if ($produk_variant->stok < $request->jumlah) {
                $response = [
                    'error' => true,
                    'message' => 'Jumlah yang diinputkan melebih stok yang disediakan, harap refresh halaman'
                ];
            } else {
                $cart = new carts();
                $cart->customer_id = auth()->user()->customers->id;
                $cart->produk_variant_id = $request->ukuran;
                $cart->qty = $request->jumlah;
                $cart->total = round($produk_variant->price * $request->jumlah);
                $cart->save();

                $response = [
                    'error' => false,
                    'message' => 'Produk berhasil ditambahkan ke keranjang'
                ];
            }
        }


        return response()->json($response);
    }

    public function updateCart(Request $request) {
        $cart = carts::find($request->id);
        $produk_variants = produk_variants::find($cart->produk_variant_id);
        $total = round($produk_variants->price * $request->qty);
        $cart->qty = $request->qty;
        $cart->total = $total;
        $cart->save();
        return response()->json([
            'error' => false,
            'message' => 'Data Keranjang berhasil diubah'
        ]);
    }

    public function detailCart(){
        $addresss = customer_address::where('customer_id',auth()->user()->customers->id)->get();
        // $jasapengirimans = JasaPengiriman::all();
        return view('user.cart.index',[
            'addresss' => $addresss,
            // 'jasapengirimans' => $jasapengirimans
        ]);
    }

    function ongkirCart(Request $request) {
        $cart = auth()->user()->customers->carts;
        $produk_variant = produk_variants::find($cart[0]->produk_variant_id);
        $origin = !empty($produk_variant->produks->merchant_id) ? $produk_variant->produks->merchant->user->kota_id : $produk_variant->produks->farmer->user->kota_id;
        $destinasi = customer_address::find($request->alamat)->kota_id;
        $weight = 0;
        foreach ($cart as $key => $value) {
            $produk_variant = produk_variants::find($value->produk_variant_id);
            $weight += $produk_variant->berat * $value->qty;
        }
        $services = $this->getCostRajaOngkir($origin, $destinasi, $weight, $request->type);
        return json_encode($services['rajaongkir']);
    }

    public function deleteCart(Request $request) {
        carts::destroy($request->id);
        return response()->json([
            'error' => false,
            'message' => 'Data Keranjang berhasil dihapus'
        ]);

    }

    function getVoucher(Request $request) {
        $voucher = vouchers::where('nama', $request->nama)->first();
        return response()->json([
            'data' => $voucher
        ]);
    }

    public function checkout(Request $request) {
        try {
            DB::beginTransaction();

            $alamat = customer_address::find($request->alamat);
            // $kurir = JasaPengiriman::find($request->pengiriman);

            $order = new orders();
            $order->customer_id = auth()->user()->customers->id;
            $order->invoice = $this->generateInvoice();
            $order->total_sebelum_discount = $request->sub_total;
            $order->total = $request->total_all;
            $order->status = 'pending';
            $order->shipping_courier = strtoupper($request->pengiriman).'('.$request->jenis_pengiriman.')';
            $order->shipping_price = $request->harga_pengiriman;
            $order->alamat = $alamat->alamat;
            $order->long = $alamat->long;
            $order->lat = $alamat->lat;

            if (!empty($request->used_voucher_id) && $request->used_voucher_id != 0) {
                $voucher = vouchers::find($request->used_voucher_id);
                $order->voucher = $voucher->nama;
                $order->type_voucher = $voucher->type;
                $order->discount = $request->total_voucher;
            }

            $order->save();

            $cart = auth()->user()->customers->carts;
            foreach ($cart as $key => $value) {
                $order_produks = new order_produks();
                $order_produks->order_id = $order->id;
                $order_produks->produk_variant_id = $value->produk_variant_id;
                $order_produks->qty = $value->qty;
                $order_produks->total = $value->total;
                $order_produks->save();


                $produk_variants = produk_variants::find($value->produk_variant_id);
                $stok = $produk_variants->stok - $value->qty;
                $produk_variants->stok = $stok;
                $produk_variants->save();
            }

            auth()->user()->customers->carts()->delete();

            DB::commit();
            session()->flash('success','Berhasil melakukan checkout');
            return redirect()->route('listorder.user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('success','Gagal melakukan checkout');
            return redirect()->route('detail-cart');
        }

    }

    public function addressUser(){
        $addresss = customer_address::where('customer_id',auth()->user()->customers->id)->get();
        return view('user.address.index',[
            'addresss' => $addresss
        ]);
    }

    public function addressUserCreate(Request $request){
        $provinsi = $this->getProvinsiRajaOngkir();
        $provinsi_id = $request->provinsi_id ?? null;
        $kota = null;
        if ($provinsi_id != null) {
            $kota = $this->getCityRajaOngkir($provinsi_id)['rajaongkir']['results'];
        }
        return view('user.address.create',[
            'provinsi' => $provinsi['rajaongkir']['results'],
            'provinsi_id' => $provinsi_id,
            'kota' => $kota
        ]);
    }

    public function addressUserStore(Request $request){
        $request->validate([
            'nama_alamat' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $address = new customer_address();
            $address->customer_id = auth()->user()->customers->id;
            $address->nama_alamat = $request->nama_alamat;
            $address->alamat = $request->alamat;
            $address->lat = $request->lat;
            $address->long = $request->long;
            $address->provinsi_id = $request->provinsi_id;
            $address->kota_id = $request->kota_id;
            $address->save();

            DB::commit();
            session()->flash('success','Berhasil menambahkan data alamat!');
            return redirect()->route('address.user');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('warning','Gagal menambahkan alamat!');
            return redirect()->route('address.user');
        }
    }

    public function addressUserEdit($id){
        $addresss = customer_address::find($id);
        return view('user.address.edit',[
            'address' => $addresss
        ]);
    }

    public function addressUserUpdate(Request $request,$id){
        $request->validate([
            'nama_alamat' => 'required',
            'alamat' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $address = customer_address::find($id);
            $address->customer_id = auth()->user()->customers->id;
            $address->nama_alamat = $request->nama_alamat;
            $address->alamat = $request->alamat;
            $address->lat = $request->lat;
            $address->long = $request->long;
            $address->save();

            DB::commit();
            session()->flash('success','Berhasil mengubah data alamat!');
            return redirect()->route('address.user');

        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            session()->flash('warning','Gagal mengubah alamat!');
            return redirect()->route('address.user');
        }
    }

    public function addressUserDestroy($id){
        $address = customer_address::find($id);
        $address->delete();
        return response()->json([
            'message' => 'Berhasil menghapus alamat!'
        ]);
    }

    public function companySetting(){
        $company = company::all();
        return view('user.company.index',[
            'company' => $company
        ]);
    }

    public function blogSetting(){
        $blog = blogs::where('status','publish')->get();
        return view('user.blog.index',[
            'blogs' => $blog
        ]);
    }

    public function blogDetail($id){
        $blog = blogs::find($id);
        return view('user.blog.show',[
            'blog' => $blog
        ]);
    }

    function login() {
        return view('user.login');
    }

    function register(Request $request) {
        $provinsi = $this->getProvinsiRajaOngkir();
        $provinsi_id = $request->provinsi_id ?? null;
        $kota = null;
        if ($provinsi_id != null) {
            $kota = $this->getCityRajaOngkir($provinsi_id)['rajaongkir']['results'];
        }
        return view('user.register',[
            'provinsi' => $provinsi['rajaongkir']['results'],
            'provinsi_id' => $provinsi_id,
            'kota' => $kota
        ]);
    }

    public function merchantUser(){
        $merchant = Merchant::where('user_id',auth()->user()->id)->first();
        return view('user.profile.merchant',[
            'merchant' => $merchant
        ]);
    }

    public function merchantStore(Request $request){
        try {
            DB::beginTransaction();
            $merchant = new Merchant();
            $merchant->user_id = auth()->user()->id;
            $merchant->nama_merchant = $request->nama_merchant;
            $merchant->alamat = $request->alamat;
            if ($request->logo) {
                $logo_merchant = $this->uploadGambar($request->logo);
                $merchant->logo = $logo_merchant;
            }
            if ($request->foto_toko) {
                $foto_merchant = $this->uploadGambar($request->foto_toko);
                $merchant->foto_toko = $foto_merchant;
            }

            $merchant->save();
            $merchant->user->role = 'merchant';
            $merchant->user->save();
            DB::commit();

            session()->flash('success','Berhasil Mendaftarkan Merchant Harap Tunggu Verifikasi Admin!');
            return redirect()->route('merchant-user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('warning','Gagal Mendaftarkan Merchant!');
            return redirect()->route('merchant-user');
        }
    }

    public function merchantUpdate(Request $request,$id){
        try {
            DB::beginTransaction();
            $merchant = Merchant::find($id);
            $merchant->user_id = auth()->user()->id;
            $merchant->nama_merchant = $request->nama_merchant;
            $merchant->alamat = $request->alamat;
            if ($request->logo) {
                $logo_merchant = $this->uploadGambar($request->logo);
                $merchant->logo = $logo_merchant;
            }
            if ($request->foto_toko) {
                $foto_merchant = $this->uploadGambar($request->foto_toko);
                $merchant->foto_toko = $foto_merchant;
            }

            $merchant->save();
            DB::commit();
            session()->flash('success','Berhasil Mengubah Data Merchant!');
            return redirect()->route('merchant-user');
        }catch (\Exception $e) {
            DB::rollback();
            session()->flash('warning','Gagal Mengubah Data Merchant!');
            return redirect()->route('merchant-user');
        }
    }

    public function farmerUser(){
        $farmer = Farmer::where('user_id',auth()->user()->id)->first();
        return view('user.profile.farmer',[
            'farmer' => $farmer
        ]);
    }

    public function farmerStore(Request $request){
        try {
            DB::beginTransaction();
            $farmer = new Farmer();
            $farmer->user_id = auth()->user()->id;
            $farmer->nama_farmer = $request->nama_farmer;
            $farmer->iot_key = 0;
            if (!empty($request->logo)) {
                $logo_farmer = $this->uploadGambar($request->logo);
                $farmer->logo = $logo_farmer;
            }
            if (!empty($request->foto_toko)) {
                $foto_farmer = $this->uploadGambar($request->foto_toko);
                $farmer->foto_toko = $foto_farmer;
            }
            $farmer->alamat = $request->alamat;

            $farmer->save();
            $farmer->user->role = 'farmer';
            $farmer->user->save();
            DB::commit();

            session()->flash('success','Berhasil Mendaftarkan Farmer Harap Tunggu Verifikasi Admin!');
            return redirect()->route('farmer-user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('warning','Gagal Mendaftarkan Farmer!');
            return redirect()->route('farmer-user');
        }
    }

    public function farmerUpdate(Request $request, $id){
        try {
            DB::beginTransaction();
            $farmer = Farmer::find($id);
            $farmer->nama_farmer = $request->nama_farmer;
            $farmer->iot_key = $request->iot_key;
            $farmer->alamat = $request->alamat;
            if ($request->logo) {
                $logo_farmer = $this->uploadGambar($request->logo);
                $farmer->logo = $logo_farmer;
            }
            if ($request->foto_toko) {
                $foto_farmer = $this->uploadGambar($request->foto_toko);
                $farmer->foto_toko = $foto_farmer;
            }

            $farmer->save();
            DB::commit();

            session()->flash('success','Berhasil Mengubah Data Farmer!');
            return redirect()->route('farmer-user');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            session()->flash('warning','Gagal Mengubah Farmer!');
            return redirect()->route('farmer-user');
        }
    }


    public function terimakasih(){
        return view('user.terimakasih');
    }
}
