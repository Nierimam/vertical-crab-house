<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoriesController extends Controller
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
            $data = categories::where('id','!=',0)->orderBy('created_at','desc');
        }elseif(auth()->user()->role == 'merchant'){
            $data = categories::where('type','merchant')->orderBy('created_at','desc');
        }elseif(auth()->user()->role == 'farmer'){
            $data = categories::where('type','farmer')->orderBy('created_at','desc');
        }
        if (isset($search) && !empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $data = $data->paginate(7);
        return view('admin.kategori.index',[
            'data' => $data,
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
        return view('admin.kategori.create');
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
            'name' => 'string|min:5|max:25'
        ],[
            'name.min' => 'Nama Kategori Minimal 5 Karakter'
        ]);

        if (!$validasi->fails()) {
            $kategori = new categories();
            $kategori->name = $request->name;
            $kategori->type = $request->type;
            $kategori->save();
            session()->flash('success','Berhasil Menambah Kategori');
            return redirect()->route('kategori.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('kategori.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = categories::find($id);
        return view('admin.kategori.edit',[
            'kategori' => $kategori
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = Validator::make( $request->all(),[
            'name' => 'string|min:5|max:25',
            'type' => 'required|string'
        ],[
            'name.min' => 'Nama Kategori Minimal 5 Karakter',
            'type.required' => 'Type Kategori harus dipilih'
        ]);

        if (!$validasi->fails()) {
            $categories = categories::find($id);
            $categories->name = $request->name;
            $categories->type = $request->type;
            $categories->save();
            session()->flash('success','Berhasil Edit Kategori');
            return redirect()->route('kategori.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('kategori.edit', $id);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        categories::destroy($id);
        return response()->json([
            'message' => 'Berhasil Menghapus Data'
        ]);
    }
}
