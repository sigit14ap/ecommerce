<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Cart;
use Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        $cart = DB::table('barang')
                        ->join('cart','barang.id','=','cart.id_barang')
                        ->join('kategori','barang.id_kategori','=','kategori.id')
                        ->select('cart.*','kategori.*','barang.*','cart.*','barang.slug as slugbar','barang.id as id_barang','kategori.slug as slug','cart.id_barang as cartbarang')
                        ->where('cart.id_user','=',$id_user)
                        ->get();
        $sum = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('status','=', 1)
                    ->get(array(
                                DB::raw('SUM(total) as count_total'),
                                DB::raw('SUM(qty) as count_qty'),
                                DB::raw('COUNT(id_barang) as count_barang'),
                                DB::raw('COUNT(status) as count_status')
                              ));
        $count = BarangController::count_cart();
        return view('users/cart',compact('cart','count','sum'));
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
        if (is_null($request->qty)) {
            $request->qty = 1;
        }else{
        $this->validate($request,[
        'qty' => 'required|integer|between:1,1000'
        ]);
        }
        if($request->submitbutton == "cart"){
        $id_user = Auth::user()->id;
        $count = BarangController::count_cart();
            if(Auth::check() && Auth::user()->level == 'users'){
                $cek = DB::table('barang')
                        ->where('slug','=',$request->slugbarang)
                        ->first();
                if (is_null($cek)) {
                    Session::flash('error_msg', 'Produk Tidak Ditemukan');
                    return view('error',compact('count'));
                }else{
                    $cek_cart = DB::table('cart')
                                ->where('cart.id_barang','=',$cek->id)
                                ->where('cart.id_user','=',$id_user)
                                ->join('barang','cart.id_barang','=','barang.id')
                                ->select('barang.*','cart.*','barang.id as id_barang')
                                ->first();
                    if($cek_cart){
                        if ($cek_cart->qty+$request->qty > $cek_cart->stok) {
                            Session::flash('error_msg', $cek_cart->judul.' Hanya Tersedia '.$cek_cart->stok.' Stok');
                            return view('error',compact('count'));
                        }else{
                            $cart = DB::table('cart')
                                    ->where('id_barang','=', $cek->id)
                                    ->where('id_user','=', $id_user)
                                    ->update(['qty' => $cek_cart->qty+$request->qty,
                                              'total' => $cek_cart->total+($cek_cart->harga*$request->qty),
                                               'status' => 1]);
                            Session::flash('success_msg', 'Ditambahkan Ke Keranjang');
                            return redirect()->route('cart');
                        }
                    }else{
                        if ($request->qty > $cek->stok) {
                            Session::flash('error_msg', $cek->judul.' Hanya Tersedia '.$cek->stok.' Stok');
                            return view('error',compact('count'));
                        }else{
                            $cart = new Cart;
                            $cart->id_user = $id_user;
                            $cart->id_barang = $cek->id;
                            $cart->qty = $request->qty;
                            $cart->total = $request->qty*$cek->harga;
                            $cart->status = 1;
                            $cart->save();
                            Session::flash('success_msg', 'Ditambahkan Ke Keranjang');
                            return redirect()->route('cart');
                        }
                    }
                }
            }else{
                Session::flash('error_msg', 'Forbidden Access');
                return view('error');
            }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id_user = Auth::user()->id;
        $this->validate($request,[
        'qty' => 'required|integer|between:1,1000'
        ]);
        $count = BarangController::count_cart();
        $cek_cart = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('id','=', $request->id)
                    ->first();
        $cek_barang = DB::table('barang')
                        ->where('id','=',$cek_cart->id_barang)
                        ->first();
        if (is_null($cek_barang)) {
        Session::flash('error_msg', 'Produk Tidak Ditemukan!');
        return view('error',compact('count'));
        }
        elseif (is_null($cek_cart)) {
        return response()->json(['message' => 'Data Tidak Ada Dalam Keranjang Anda'],403);
        }else{
            $cart2 = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('id','=', $request->id)
                    ->get();
            if($cek_barang->stok >= $request->qty){
            $join = DB::table('cart')->where('cart.id','=',$request->id)
                    ->join('barang','cart.id_barang','=','barang.id')
                    ->select('barang.*','cart.*','barang.id as id_barang')
                    ->get();

            $update = cart::find($request->id);
            $update->qty = $request->qty;
            $update->total = $request->qty*$join[0]->harga;
            $update->save();

            $cartt = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('id','=', $request->id)
                    ->get();

            $total = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('status','=', 1)
                    ->get(array(
                                DB::raw('SUM(total) as count_total'),
                                DB::raw('SUM(qty) as count_qty'),
                                DB::raw('COUNT(id_barang) as count_barang')
                              ));

            return response()->json(['cart' => $cartt,'total' => $total]);
            }else{
                return response()
                ->json(['message' => 'Quantity Maksimal '.$cek_barang->stok,'maks' => $cek_barang->stok,'name' => $cek_barang->judul,'cart' => $cart2],400);
            }
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
        $count = BarangController::count_cart();
        $cek = DB::table('cart')->where('id','=', $id)
                                ->where('id_user','=', Auth::user()->id)
                                ->first();

        if (is_null($cek)) {
            Session::flash('error_msg', 'Barang tidak ada di keranjang anda!');
            return view('error',compact('count'));
        }else{
            $cart = DB::table('cart')->where('id','=', $id)->delete();
            Session::flash('success_msg', 'Berhasil Dihapus!');
            return redirect()->route('cart');
        }
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);
        $cart = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('id','=', $request->id)
                    ->first();
        if ($validator->passes()) {
            if(is_null($cart)){
                return response()->json(['error'=>'Produk tidak ada di keranjang anda!'],404);
            }else{
                $update = cart::find($request->id);
                if($cart->status == 1){
                    $update->status = 0;
                }else{
                    $update->status = 1;
                }
                    $update->save();
                $total = DB::table('cart')
                        ->where('id_user','=', Auth::user()->id)
                        ->where('status','=',1)
                        ->get(array(
                                DB::raw('SUM(total) as count_total'),
                                DB::raw('SUM(qty) as count_qty'),
                                DB::raw('COUNT(id) as count_barang')
                              ));
                return response()->json(['cart'=> $total]);
            }
        }

        return response()->json(['error'=>$validator->errors()->all()],400);
    }

}
