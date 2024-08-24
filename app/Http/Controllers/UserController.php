<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
            $user = User::where('role', 'user')->orderBy('created_at','desc');
        }else{
            $user = User::where('id', auth()->user()->id)->orderBy('created_at','desc');
        }

        if (isset($search) && !empty($search)) {
            $user->where(function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhereHas('customers', function ($query2) use ($search){
                            $query2->where('nama_lengkap', 'like', '%' . $search . '%');
                });
            });
        }
        $user = $user->paginate(7);
        return view('admin.user.index', [
            'users' => $user,
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
        $user = User::find($id);
        return view('admin.user.edit', [
            'user' => $user
        ]);
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
        $validasi = Validator::make($request->all(),[
            'password' => 'confirmed'
        ]);

        if (!$validasi->fails()) {
            try {
                DB::beginTransaction();
                $user = User::find($id);
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role = 'user';
                $user->save();

                $customer = customers::where('user_id',$user->id)->first();
                $customer->nama_lengkap = $request->nama_lengkap;
                $customer->telp = $request->telp;
                $customer->tempat_lahir = $request->tempat_lahir;
                $customer->tanggal_lahir = $request->tanggal_lahir;
                if ($request->img_profile) {
                    $gambar = $this->uploadGambar($request->img_profile);
                    $customer->img_profile = $gambar;
                }
                $customer->save();

                DB::commit();
                session()->flash('success','Berhasil Mengubah Data Customer!');
                return redirect()->route('customer.index');
            } catch (\Exception $e) {
                DB::rollback();
                session()->flash('warning','Gagal Mengubah Data Customer!');
                return redirect()->back();
            }
        } else {
            session()->flash('warning','Password Yang Anda Masukkan Tidak Sama!');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json([
            'message' => 'Berhasil menghapus data customer!'
        ]);
    }
}
