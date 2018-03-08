<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\barang;
use App\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Image;
use Session;
use SlugHelp;

class BarangController extends Controller
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
                ->select('barang.*','kategori.*','barang.slug as slugbarang','barang.id as id_barang')
                ->orderBy('barang.created_at', 'desc')
                ->get();
        $kategori= kategori::all();
        $count = $this->count_cart();
        return view('home',compact('barang', 'kategori','count'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori= kategori::all();
        return view('admin/create',compact('kategori'));
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
        'judul' => 'required|string|min:5|max:255',
        'id_kategori' => 'required|integer|min:1',
        'deskripsi' => 'required|min:10',
        'berat' => 'required|integer|min:1',
        'stok' => 'required|integer|min:1',
        'harga' => 'required|min:1',
        'foto1'=> 'required|image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000',
        'foto2'=> 'required|image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000',
        'foto3'=> 'required|image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000'
        ]);

        

        $harga = str_replace('.', "", $request->harga);
        $barang = new barang;

        //Cek ID kategori
        $cek = kategori::where('id','=', $request->id_kategori)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Error - Kategori Tidak Ditemukan');
            return view('error');
        }

        $title = $request->judul;
        $id_kategori = $request->id_kategori;
        $barang->id_user = Auth::id();
        $barang->judul = $request->judul;
        $barang->slug = SlugHelp::slug_barang($title, $id = 0, $id_kategori);
        $barang->id_kategori = $request->id_kategori;
        $barang->deskripsi = $request->deskripsi;
        $barang->berat = $request->berat;
        $barang->stok = $request->stok;
        $barang->harga = $harga;
        $barang->foto1 = round(microtime(true)) . '.' . uniqid($request->foto1->getClientOriginalName(),true). '.' . $request->foto1->getClientOriginalExtension();
        $barang->foto2 = round(microtime(true)) . '.' . uniqid($request->foto2->getClientOriginalName(),true) . '.' . $request->foto2->getClientOriginalExtension();
        $barang->foto3 = round(microtime(true)) . '.' . uniqid($request->foto3->getClientOriginalName(),true). '.' . $request->foto3->getClientOriginalExtension();
        $barang->save();
        $destinationPath = public_path('img/uploads');
        $foto1 = Image::make($request->foto1->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$barang->foto1);
        $foto2 = Image::make($request->foto2->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$barang->foto2);
        $foto3 = Image::make($request->foto3->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$barang->foto3);
        Session::flash('success_msg', 'Post added successfully!');
         return redirect()->route('manage_product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($bagian,$slug=0,$slugbarang=0,Request $request)
    {    
        $count = $this->count_cart();
        if(!$slug && !$slugbarang){
            $cek = kategori::where('bagian','=',$bagian)->first();
            if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error',compact('count'));
            }
            $kategori = kategori::where('bagian','=',$bagian)
                    ->join('barang','barang.id_kategori','=','kategori.id')
                    ->select('barang.*','kategori.*','barang.slug as slugbar','barang.id as id_barang')
                    ->paginate(6);
            $allcat = kategori::where('bagian','=',$bagian)
                    ->get();
            Session::flash('cat_msg', $allcat[0]->bagian);
            Session::flash('allcat', $allcat);
            return view('kategori',compact('kategori', 'allcat','count'));
        }elseif(!$slugbarang){
            $cek = kategori::where('bagian','=',$bagian)->where('kategori.slug','=',$slug)->first();
            if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error',compact('count'));
            }
            $kategori = kategori::where('kategori.bagian','=',$bagian)->where('kategori.slug','=',$slug)
                    ->join('barang','barang.id_kategori','=','kategori.id')
                    ->select('barang.*','kategori.*','barang.slug as slugbar','barang.id as id_barang')
                    ->paginate(6);
            $allcat = kategori::where('bagian','=',$bagian)
                    ->get();
            if ($kategori->count() == 0){
                $cat = kategori::where('bagian','=',$bagian)->where('kategori.slug','=',$slug)->first();
                Session::flash('cat_msg', $cat->nama_kat.' '.$cat->bagian);
            }else{
            Session::flash('cat_msg', $kategori[0]->nama_kat.' '.$kategori[0]->bagian);
            }
            Session::flash('allcat', $allcat);
            return view('kategori',compact('kategori', 'allcat','count'));
        }
        $cek = barang::where('slug','=', $slugbarang)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error',compact('count'));
        }else{
        $product = barang::where('barang.slug','=', $slugbarang)
                ->join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbar','barang.id as id_barang')
                ->where('kategori.bagian','=', $bagian)
                ->where('kategori.slug','=', $slug)
                ->get();
        $allcat = kategori::where('bagian','=',$bagian)
                ->get();
        return view('detail',compact('product', 'allcat','count'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek = barang::where('id','=',$id)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error');
            }
        $barang= barang::where('barang.id','=',$id)
                ->join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbarang','barang.id as id_barang')
                ->first();
        $kategori= kategori::all();
        return view('admin/edit',compact('barang', 'kategori'));
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
        $cek = barang::where('id','=',$id)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Not Found!');
            return view('error');
            }
        $this->validate($request,[
        'judul' => 'required|string|min:5|max:255',
        'id_kategori' => 'required|integer|min:1',
        'deskripsi' => 'required|min:10',
        'berat' => 'required|integer|min:1',
        'stok' => 'required|integer|min:1',
        'harga' => 'required|min:1'
        ]);

        $barang= barang::where('barang.id','=',$id)
                ->join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbarang','barang.id as id_barang','kategori.id as id_kategori')
                ->first();

        $title = $request->judul;
        $id_kategori = $request->id_kategori;
        $update = barang::find($id);
        $update->judul = $request->judul;
        $update->slug = SlugHelp::slug_barang($title, $id = $barang->id_barang, $id_kategori);
        $update->id_kategori = $request->id_kategori;
        $update->deskripsi = $request->deskripsi;
        $update->berat = $request->berat;
        $update->stok = $request->stok;
        $update->harga = str_replace('.', "", $request->harga);

        $destinationPath = public_path('img/uploads');
        if(!is_null($request->foto1 && $request->foto2 && $request->foto3)){
            $this->validate($request,[
            'foto1'=> 'image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000',
            'foto2'=> 'image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000',
            'foto3'=> 'image|mimes:jpg,jpeg,JPEG,png,gif,bmp|max:5000'
            ]);
            if(!is_null($request->foto1)){
            $update->foto1 = round(microtime(true)) . '.' . uniqid($request->foto1->getClientOriginalName(),true). '.' . $request->foto1->getClientOriginalExtension();
            $foto1 = Image::make($request->foto1->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$update->foto1);
            $delfoto = unlink($destinationPath.'/'.$barang->foto1);
            }
            if(!is_null($request->foto2)){
            $update->foto2 = round(microtime(true)) . '.' . uniqid($request->foto2->getClientOriginalName(),true) . '.' . $request->foto2->getClientOriginalExtension();
            $foto2 = Image::make($request->foto2->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$update->foto2);
            $delfoto = unlink($destinationPath.'/'.$barang->foto2);
            }
            if(!is_null($request->foto3)){
            $update->foto3 = round(microtime(true)) . '.' . uniqid($request->foto3->getClientOriginalName(),true). '.' . $request->foto3->getClientOriginalExtension();
            $foto3 = Image::make($request->foto3->getRealPath())->resize(500, 500)->save($destinationPath.'/'.$update->foto3);
            $delfoto = unlink($destinationPath.'/'.$barang->foto3);
            }
            
            
        }
        $update->save();
        Session::flash('success_msg', 'Post edited successfully!');
        return redirect()->route('manage_product');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_barang)
    {
        $cek = barang::where('id','=', $id_barang)->first();
        if (is_null($cek)) {
            Session::flash('error_msg', 'Produk Tidak Ditemukan!');
            return view('create');
        }else{
        $path = array('img/uploads/'.$cek->foto1,'img/uploads/'.$cek->foto2,'img/uploads/'.$cek->foto3);
        foreach ($path as $file) {
            $unlink = unlink(public_path($file));
        }
        $cat = barang::where('id','=', $id_barang)->delete();
        Session::flash('success_msg', 'Berhasil Dihapus!');
        return redirect()->route('create');
        }
    }

    public function search(Request $request)
    {
        $this->validate($request,[
        'q' => 'required|string|min:1'
        ]);
        $barang = new barang;
        $search = $request->get('q');
        $kategori = barang::join('kategori','barang.id_kategori','=','kategori.id')
                ->select('barang.*','kategori.*','barang.slug as slugbar','barang.id as id_barang')
                ->where('barang.judul','LIKE','%'.$search.'%')
                ->orWhere('kategori.nama_kat','LIKE', '%'.$search.'%')
                ->orWhere('kategori.bagian','LIKE', '%'.$search.'%')
                ->paginate(6);
        $allcat = kategori::all();
        $count = $this->count_cart();
        Session::flash('cat_msg', $search);
        Session::flash('search', "Pencarian ".$search);
        return view('kategori',compact('kategori', 'allcat','count'));
    }

    public static function count_cart(){
        if(Auth::check()){
            $count = DB::table('cart')->where('id_user','=',Auth::user()->id)->count();
            return $count;
        }else{
            return false;
        }
    }
}
