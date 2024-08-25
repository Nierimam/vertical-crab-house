<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = company::all();
        return view('admin.company.index',[
            'company' => $data
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
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        return view('admin.company.show',[
            'data' => $company
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        return view('admin.company.edit',[
            'data' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        $validasi = Validator::make( $request->all(),[
            'nama' => 'required|string',
            'deskripsi' => 'required',
            'telp' => 'required|min:10|max:13',
            'visi' => 'required',
            'misi' => 'required',
            'alamat' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'tiktok' => 'required',
            'shopee' => 'required',
            'tokopedia' => 'required',
            'logo' => 'mimes:jpg,png,webp,svg,jpeg,gif'
        ],[
            'telp.min' => 'Minimal 10 digit untuk No Telepon',
            'telp.max' => 'Maximal 13 digit untuk No Telepon',
            'logo.mimes' => 'Format Logo harus : jpg,png,webp,svg,jpeg,gif'
        ]);

        if (!$validasi->fails()) {
            $company->nama = $request->nama;
            $company->deskripsi = $request->deskripsi;
            $company->telp = $this->formatNumberHp($request->telp);
            if ($request->logo) {
                $company->logo = $this->uploadGambar($request->logo);
            }
            $company->visi = $request->visi;
            $company->misi = $request->misi;
            $company->alamat = $request->alamat;
            $company->facebook = $request->facebook;
            $company->instagram = $request->instagram;
            $company->linkedin = $request->linkedin;
            $company->tiktok = $request->tiktok;
            $company->shopee = $request->shopee;
            $company->tokopedia = $request->tokopedia;
            $company->save();
            session()->flash('success','Berhasil Edit Company Setting');
            return redirect()->back();
        }else{
            // dd($validasi);
            session()->flash('error',$validasi->errors()->first());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        //
    }
}
