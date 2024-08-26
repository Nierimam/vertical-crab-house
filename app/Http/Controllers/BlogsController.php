<?php

namespace App\Http\Controllers;

use App\Models\blog_medias;
use App\Models\blogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = blogs::where('id','!=',0)
        ->orderBy('created_at','desc');
        if (isset($search) && !empty($search)) {
            $data->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%');
            });
        }
        $data = $data->paginate(10);
        return view('admin.blog.index',[
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
        return view('admin.blog.create');
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
            'judul' => 'required|string|min:6',
            'deskripsi' => 'required',
            'status' => 'required',
            'img.*' => 'required|mimes:jpg,png,webp,svg,jpeg,gif'
        ],[
            'judul.min' => 'Judul Minimal 6 Karakter',
            'gambar.*.mimes' => 'Format Gambar harus: jpg,png,webp,svg,jpeg,gif'
        ]);

        if (!$validasi->fails()) {
            $blog = new blogs();
            $blog->judul = $request->judul;
            $blog->deskripsi = $request->deskripsi;
            $blog->status = $request->status;
            if ($request->status == 'publish') {
                $blog->tanggal_publish = Carbon::now('Asia/Makassar');
            }
            $blog->is_featured = false;
            $blog->save();

            foreach ($request->img as $value) {
                $media = new blog_medias();
                $gambar = $this->uploadGambar($value);
                $media->blog_id = $blog->id;
                $media->media = $gambar;
                $media->save();

            }
            session()->flash('success','Berhasil Menambah Blog');
            return redirect()->route('blog.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('blog.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blogs = blogs::find($id);
        $medias = blog_medias::where('blog_id', $id)->get();
        return view('admin.blog.show', [
            'blog' => $blogs,
            'media' => $medias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = blogs::find($id);
        $media = blog_medias::where('blog_id', $id)->get();
        return view('admin.blog.edit',[
            'data' => $data,
            'media' => $media
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = Validator::make( $request->all(),[
            'judul' => 'required|string|min:6',
            'deskripsi' => 'required',
            'status' => 'required',
            'img.*' => 'required|mimes:jpg,png,webp,svg,jpeg,gif'
        ],[
            'judul.min' => 'Judul Minimal 6 Karakter',
            'gambar.*.mimes' => 'Format Gambar harus: jpg,png,webp,svg,jpeg,gif'
        ]);


        if(!$validasi->fails()){
            if (isset($request->gambar_blog_delete) && !empty($request->gambar_blog_delete)) {
                $gambar_hidden = explode(',', $request->gambar_blog_delete);
                if (count($gambar_hidden) > 0) {
                    foreach ($gambar_hidden as $key => $value) {
                        $gambar = blog_medias::find($value);
                        if ($gambar != null) {
                            $gambar->delete();
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
                        $gambar = blog_medias::find($value);
                        $gambarUpload = $this->uploadGambar($gambar_update[$key]);
                        $gambar->media = $gambarUpload;
                        $gambar->save();
                    }
                }
            }

            $blog = blogs::find($id);
            $blog->judul = $request->judul;
            $blog->deskripsi = $request->deskripsi;
            $blog->status = $request->status;
            if ($request->status == 'publish') {
                $blog->tanggal_publish = Carbon::now('Asia/Makassar');
            }elseif ($request->status == 'non publish') {
                $blog->tanggal_publish = null;
            }
            $blog->save();

            if (isset($request->img)) {
                foreach ($request->img as $value) {
                    $media = new blog_medias();
                    $gambar = $this->uploadGambar($value);
                    $media->blog_id = $blog->id;
                    $media->media = $gambar;
                    $media->save();

                }
            }
            session()->flash('success','Berhasil Edit Blog');
            return redirect()->route('blog.index');
        }else{
            session()->flash('error',$validasi->errors()->first());
            return redirect()->route('blog.edit', $id);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        blogs::destroy($id);
        return response()->json([
            'message' => 'Data Blog Berhasil Dihapus'
        ]);
    }
}
