<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;
use App\Wilayah;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $admin = DB::table('profile')
                    ->join('wilayah','profile.id_kota','=','wilayah.city_id')
                    ->join('users','profile.id_user','=','users.id')
                    ->select('profile.*','wilayah.*','profile.id as id_profile','users.*','users.id as user_id')
                    ->where('profile.role','=','admin')
                    ->orderBy('profile.status','asc')
                    ->get();
        return view('profile',compact('count','wilayah','address','city','admin'));
         
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
        $validator = Validator::make($request->all(), [
            'jenis_alamat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'telepon' => 'required|numeric|min:10',
            'id_provinsi' => 'required|integer',
            'id_kota' => 'required|integer',
            'alamat'=> 'required|min:5'
        ]);
        if ($validator->passes()) {
            $cek = DB::table('wilayah')
                        ->where('province_id','=',$request->id_provinsi)
                        ->where('city_id','=',$request->id_kota)
                        ->first();
            $cek_profile = DB::table('profile')
                        ->where('id_user','=',Auth::user()->id)
                        ->first();
            $cek_admin = DB::table('profile')
                        ->where('role','=', "admin")
                        ->where('status','=','active')
                        ->get();
            if($cek_profile){
                return response()->json(['message' => ['Anda Sudah Mempunyai Alamat !']],400);
            }elseif(is_null($cek)){
                return response()->json(['message' => 'Pastikan Data Terisi Dengan Benar !'],400);
            }else{
                $address = new Profile;
                $address->id_user = Auth::id();
                $address->jenis_alamat = $request->jenis_alamat;
                $address->nama = $request->nama;
                $address->telepon = $request->telepon;
                $address->id_provinsi = $request->id_provinsi;
                $address->id_kota = $request->id_kota;
                $address->alamat = $request->alamat;
                if(Auth::user()->level == "admin"){
                    $address->role = "admin";
                    if(count($cek_admin) >= 1){
                        $address->status = "inactive";
                    }
                }
                $address->save();

                $add = DB::table('profile')
                        ->join('wilayah','profile.id_kota','=','wilayah.city_id')
                        ->select('profile.*','wilayah.*','profile.id as id_profile')
                        ->where('profile.id_user','=',Auth::user()->id)
                        ->get();
                if($address){
                    return response()->json(['address' => $add,'message' => ['Alamat Berhasil Ditambahkan !']],200);
                }else{
                    return response()->json(['message' => ['Alamat Gagal Diubah']],400);
                }
            }
        }else{
            return response()->json(['message'=> [$validator->errors()->all()]],400);
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
        $this->validate($request,[
        'jenis_alamat' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'telepon' => 'required|numeric|min:10',
        'id_provinsi' => 'required|integer',
        'id_kota' => 'required|integer',
        'alamat'=> 'required|min:5'
        ]);
        $cek = DB::table('wilayah')
                    ->where('province_id','=',$request->id_provinsi)
                    ->where('city_id','=',$request->id_kota)
                    ->first();
        $cek_profile = DB::table('profile')
                        ->where('id_user','=',Auth::user()->id)
                        ->first();
        $count = DB::table('cart')->where('id_user','=',Auth::user()->id)->count();
        if(is_null($cek)){
            Session::flash('error_msg', 'Pastikan data terisi dengan benar!');
            return view('error',compact('count'));
        }elseif (!$cek_profile) {
            Session::flash('error_msg', 'Forbidden Access!');
            return view('error',compact('count'));
        }else{
            $update = profile::find($request->id);
            $update->id_user = Auth::id();
            $update->jenis_alamat = $request->jenis_alamat;
            $update->nama = $request->nama;
            $update->telepon = $request->telepon;
            $update->id_provinsi = $request->id_provinsi;
            $update->id_kota = $request->id_kota;
            $update->alamat = $request->alamat;
            $update->save();

            $address = DB::table('profile')
                    ->join('wilayah','profile.id_kota','=','wilayah.city_id')
                    ->select('profile.*','wilayah.*','profile.id as id_profile')
                    ->where('profile.id_user','=',Auth::user()->id)
                    ->get();

            if($update){
                return response()->json(['alamat' => $address,'message' => ['Alamat Berhasil Diubah !']],200);
            }else{
                return response()->json(['message' => ['Alamat Gagal Diubah']],400);
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
        //
    }

    public function wilayah(Request $request)
    {
            $cities = DB::table("wilayah")
                    ->where('province_id','=',$request->province_id)
                    ->get();
            return response()->json($cities);
    }


    public function activate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);
        if ($validator->passes()) {
            if(Auth::user()->level == "admin"){
                $cek = DB::table('profile')->where('id','=',$request->id)->where('role','=', 'admin')->first();
                if(is_null($cek)){
                    return response()->json(['message'=>'Alamat Tidak Ditemukan!'],404);
                }else{
                    if($cek->status == "active"){
                        return response()->json(['message'=>'Alamat Sudah Aktif!'],400);
                    }else{
                        $ubah = DB::table('profile')
                                    ->where('role','=', 'admin')
                                    ->where('status','=', 'active')
                                    ->update(['status' => 'inactive']);
                        if($ubah){
                        $update = DB::table('profile')
                                    ->where('id','=', $request->id)
                                    ->update(['status' => 'active']);
                        return response()->json(['message'=>'Alamat Dipilih!'],200);
                        }
                    }
                }
            }else{
                return response()->json(['message'=>'Forbidden Access!'],403);
            }
        }else{
            return response()->json(['message'=>$validator->errors()->all()],400);
        }
    }    

}
