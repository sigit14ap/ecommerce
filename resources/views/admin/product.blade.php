@extends('layouts.app')
@section('main-content')
@section('title', 'Daftar Produk')
<style type="text/css">
@media (max-width: 768px){
#detail{
color: black;max-width: 64%;word-wrap:break-word;
}
}
.table-bordered {
    border:0px !important;
}
tr.border_bottom td {
  border-bottom:1pt solid black;
}
tr.border_bottom td {
    border-bottom: 1px solid #ccc!important;
}
</style>
<div class="container">
	@if(Session::has('success_msg'))
    <div class="col-md-12">
    	<div class="alert alert-success alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <i class="fa fa-check fa-lg" aria-hidden="true"></i>&nbsp;{{ Session::get('success_msg') }}
		</div>
    </div>
    @endif

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Kelola Produk</li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="box" style="float: left;width: 100%;">
                        <h1>Daftar Produk</h1>
                        <hr>
                        @if($count == 0)
                        <center>
                        <h3>Belum ada produk.</h3>
		         		<a href="{{ route('create') }}"><button class="btn btn-default btn-lg"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Tambahkan Produk</button></a>
		         		</center>
                        @else
                        <div style="float: right;">
                        	<a href="{{ route('create') }}"><button class="btn btn-primary btn-lg"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Tambahkan Produk</button></a>
                        </div>
                        @foreach($barang as $cat)
                        <div class="panel panel-default" style="float: left;margin-top: 19px;">
                                  <div class="panel-heading">
                                        <h4>{{date("H:i:s".'  |  '."d-m-Y", strtotime($cat->tanggal))}}</h4>
                                    <div style="float: right;margin: -37px 2px 1px;">
                                    <form id="delete-form-{{ $cat->id }}" method="post" action="{{ route('destroy',$cat->id_barang) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                </form>
                                                <button class="btn btn-default" data-toggle="modal" data-target="#myModal{!! $cat->id!!}"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button>
                                        <div class="modal fade" id="myModal{!! $cat->id!!}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Hapus Produk <strong>{{ $cat->judul }}</strong> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $cat->id }}').submit();"><button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                    </div>
                                </div>
                                  <div class="panel-body">
                                  <div class="media">
                                    <div class="media-left media-top">
                                        <a href="../{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbarang}}">
                                                <img src="{{asset('img/uploads/'.$cat->foto1)}}" class="media-object" style="width:80px">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                      <p class="media-heading">
                                        	<a href="../{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbarang}}">
                                        	<label style="font-size: 18px;font-weight: 600;color: #00698c;margin-bottom: 10px;">{{$cat->judul}}</label></a><br>
                                        	Kategori : <strong>{{$cat->nama_kat.' '.$cat->bagian}}</strong><br>
                                        	Harga : <strong>Rp{{number_format($cat->harga,0,",",".")}}</strong><br>
                                        	Stok : <strong>{{$cat->stok}}</strong><br>
                                      </p>
                                    </div>
                                  </div>
                                  </div>
                                  <div class="panel-footer">
                                    <a href="{{ route('get.update',$cat->id_barang) }}">
                                    <button class="btn btn-default btn-lg btn-block"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i>Ubah Produk</button></a>
                                  </div>
                                </div>
                        @endforeach
                        <div class="col-md-12 col-xs-6">
                            <center>
                            @if($barang->currentPage() > $barang->lastPage())
                            <meta http-equiv="refresh" content="0; url={{$barang->url($barang->lastPage())}}">
                            @else
                            {{ $barang->links() }}
                            @endif
                            </center>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
@endsection