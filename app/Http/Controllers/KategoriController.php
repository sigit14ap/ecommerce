<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\kategori;
use Session;
use Image;
use SlugHelp;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $barang= DB::table('barang')
                ->join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbarang','barang.id as id_barang','barang.created_at as tanggal')
                ->orderBy('barang.created_at', 'desc')
                ->paginate(2);
        $count = DB::table('barang')
                ->join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbarang','barang.id as id_barang','barang.created_at as tanggal')
                ->orderBy('barang.created_at', 'desc')
                ->count();
        $kategori= kategori::all();
        return view('admin/product',compact('barang', 'kategori','count'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori= kategori::all();
        return view('admin/newkategori',compact('kategori', $kategori));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
        'nama_kat' => 'required|string|min:1|max:255',
        'foto'=> 'required|image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000'
        ]);

        if($request->bagian == 'Pria' || $request->bagian == 'Wanita'){

        $cat = new kategori;
        $title = $request->nama_kat;
        $bagian = $request->bagian;
        $cat->nama_kat = $request->nama_kat;
        $cat->slug = SlugHelp::slug_category($title, $bagian, $id = 0);
        $cat->bagian = $request->bagian;
        $cat->foto = round(microtime(true)) . '.' . uniqid($request->foto->getClientOriginalName(),true). '.' . $request->foto->getClientOriginalExtension();
        $cat->save();
        $destinationPath = public_path('img/categories');
        $foto1 = Image::make($request->foto->getRealPath())->resize(200, 200)->save($destinationPath.'/'.$cat->foto);
        Session::flash('success_msg', 'Category added successfully!');
         return redirect()->route('createcat');
        }else{
            Session::flash('error_msg', 'Error - Bagian Kategori Tidak Ditemukan');
            return view('error');
        }
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
        $cek = kategori::where('id','=',$id)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error');
            }
        $kategori = kategori::where('id','=',$id)->first();
        return view('admin/editkategori',compact('kategori'));
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
        $cek = kategori::where('id','=',$id)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error');
        }
        if($request->bagian == 'Pria' || $request->bagian == 'Wanita'){
        $this->validate($request,[
        'nama_kat' => 'required|string|min:1|max:255',
        ]);

        $kategori = kategori::where('id','=',$id)->first();
        $destinationPath = public_path('img/categories');
        
        $title = $request->nama_kat;
        $bagian = $request->bagian;

        $update = kategori::find($id);
        $update->nama_kat = $request->nama_kat;
        $update->slug = SlugHelp::slug_category($title, $bagian, $id = $kategori->id);;
        $update->bagian = $request->bagian;
        if(!is_null($request->foto)){
            $this->validate($request,[
            'foto'=> 'image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000'
            ]);
            $update->foto = round(microtime(true)) . '.' . uniqid($request->foto->getClientOriginalName(),true). '.' . $request->foto->getClientOriginalExtension();
            $foto1 = Image::make($request->foto->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$update->foto);
            $delfoto = unlink($destinationPath.'/'.$kategori->foto);
        }
        $update->save();
        Session::flash('success_msg', 'Category edited successfully!');
        return redirect()->route('edit', ['id' => $id]);
        }else{
            Session::flash('error_msg', 'Error - Bagian Kategori Tidak Ditemukan');
            return view('error');
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
        $cek = kategori::where('id','=', $id)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Kategori Tidak Ditemukan!');
            return view('newkategori');
        }else{
        $path = unlink(public_path('img/categories/'.$cek->foto));
        $cat = kategori::where('id','=', $id)->delete();
        Session::flash('success_msg', 'Berhasil Dihapus!');
        return redirect()->route('createcat');
        }
    }
}
