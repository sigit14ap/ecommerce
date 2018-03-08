<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Cart;
use App\Order;
use App\Detail_order;
use Webpatser\Uuid\Uuid;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.orders');
    }

    public function index()
    {
        $wilayah = DB::table('wilayah')->groupBy('province_id')->get();
        $city = DB::table('wilayah')->get();
        $count = DB::table('cart')->where('id_user','=',Auth::user()->id)->count();
        $address = DB::table('profile')
                    ->join('wilayah','profile.id_kota','=','wilayah.city_id')
                    ->select('profile.*','wilayah.*','profile.id as id_profile')
                    ->where('profile.id_user','=',Auth::user()->id)
                    ->first();

        $sum = DB::table('cart')
                    ->join('barang','cart.id_barang','=','barang.id')
                    ->select('barang.*','cart.*','cart.id as cart_id')
                    ->where('cart.id_user','=', Auth::user()->id)
                    ->where('cart.status','=', 1)
                    ->get();

        $all_cart = DB::table('cart')
                    ->select(
                            DB::raw('SUM(total) as count_total'),
                            DB::raw('SUM(qty) as count_qty'),
                            DB::raw('COUNT(id_barang) as count_barang'),
                            DB::raw('COUNT(status) as count_status'))
                    ->where('id_user','=', Auth::user()->id)
                    ->where('status','=', 1)
                    ->get();

        $cart = DB::table('cart')
                    ->where('id_user','=', Auth::user()->id)
                    ->where('status','=', 1)
                    ->first();
        $cart2 = DB::table('cart')
                ->where('id_user','=', Auth::user()->id)
                ->first();

        if(is_null($cart2)){
            Session::flash('err_msg', 'Tidak ada produk dikeranjang Anda!');
            return redirect()->route('cart');
        }elseif(is_null($cart)){
            Session::flash('err_msg', 'Pastikan sudah memilih produk dahulu!');
            return redirect()->route('cart');
        }else{

            $invoice = strtoupper('INV-'.Uuid::generate());

            foreach ($sum as $x) {
                $move = new Order;
                $move->invoice = $invoice;
                $move->id_user = Auth::id();
                $move->id_barang = $x->id_barang;
                $move->qty = $x->qty;
                $move->total = $x->total;
                $move->berat = $x->berat*$x->qty;
                $move->save();
            }

            if($move){
                $detail = new Detail_order;
                $detail->invoice = $invoice;
                $detail->detail_total = $all_cart[0]->count_total;
                $detail->status = "pending";
                $detail->save();
                // $delete = DB::table('cart')
                //         ->where('id_user','=', Auth::user()->id)
                //         ->where('status','=', 1)
                //         ->delete();
            }
            return view('users.order',compact('count','wilayah','address','city','all_cart'));
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ongkir(Request $request)
    {
        $users = DB::table('profile')
                    ->where('id_user','=',Auth::user()->id)
                    ->where('role','=','users')
                    ->first();

        $admin = DB::table('profile')
                    ->where('role','=','admin')
                    ->where('status','=','active')
                    ->first();

        $item = DB::table('order')
                    ->select(DB::raw('SUM(berat) as count_berat'))
                    ->where('id_user','=',Auth::user()->id)
                    ->first();

        if(is_null($users)){
            return response()->json(['message'=>'Anda Belum Punya Alamat!'],400);
        }elseif(is_null($admin)){
            return response()->json(['message'=>'Error! Alamat asal tidak ada , Hubungi Admin'],400);
        }else{
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "origin=".$admin->id_kota."&destination=".$users->id_kota."&weight=".$item->count_berat."&courier=".$request->kurir."",
              CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 2e99e8d9c0fe2eeb8a23da16f1bc0a5c"
              ),
            ));
         
            $response = curl_exec($curl);
            $err = curl_error($curl);
         
            curl_close($curl);
         
            if ($err) {   
                return $err;
            } else {
              return $response;
            }
        }
    }
}
