@extends('layouts.app')
@section('main-content')

@if(Session::has('search'))
@section('title', Session::get('search'))
@elseif(Session::has('allcat'))
@section('title', Session::get('cat_msg'))
@else
@section('title', $kategori[0]->nama_kat.' '.$kategori[0]->bagian)
@endif
<style type="text/css">
.loader {
  border: 3px solid #f3f3f3;
  border-radius: 50%;
  border-top: 3px solid blue;
  border-bottom: 3px solid blue;
  width: 150px;
  height: 150px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>
                            @if(Session::has('search'))
                            {{ Session::get('search') }}
                            @else
                            {{$allcat[0]->bagian}}
                            @endif
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                @if(Session::has('search'))
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li class="active">
                                    <a href="../Pria">Pria</a>
                              @foreach($allcat as $cat)
                              @if($cat->bagian == "Pria")
                                
                                    <ul>
                                        <li><a href="../{{$cat->bagian.'/'.$cat->slug}}">{{$cat->nama_kat}}</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                            @if(Session::has('search'))
                            <li class="active">
                                    <a href="../Wanita">Wanita</a>
                            @foreach($allcat as $cat)
                              @if($cat->bagian == "Wanita")
                              
                                    <ul>
                                        <li><a href="../{{$cat->bagian.'/'.$cat->slug}}">{{$cat->nama_kat}}</a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                              @endforeach
                              @endif
                            </ul>

                        </div>
                    </div>
                @endif


                    <!-- *** MENUS AND FILTERS END *** -->
                                        <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                 @if(Session::has('allcat'))
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li class="active">
                                    <a href="../{{$allcat[0]->bagian}}">{{$allcat[0]->bagian}}</a>
                              @foreach($allcat as $cat)
                              
                                    <ul>
                                        <li><a href="../{{$cat->bagian.'/'.$cat->slug}}">{{$cat->nama_kat}}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                            
                            </ul>

                        </div>
                    </div>
                @endif

                    <!-- *** MENUS AND FILTERS END *** -->
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>
                            @if(Session::has('cat_msg'))
                            {{ Session::get('cat_msg') }}
                            @endif
                        </h1>
                        <p>
                            Menampilkan Hasil Dari
                            <strong>
                            @if(Session::has('cat_msg'))
                            {{ Session::get('cat_msg') }}
                            @endif
                            </strong></p>
                    </div>

                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing <strong>{{$kategori->count()}}</strong> of <strong>{{$kategori->total()}}</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Urutkan</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option value="harga">Harga</option>
                                                    <option value="new">Terbaru</option>
                                                    <option value="sold">Terlaris</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box"><center><div class="loader" id="loading"></div></center></div>
                    <div class="row products">
                     @foreach($kategori as $cat)
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            @if(Session::has('search'))
                                            <a href="{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbar}}">
                                            @else
                                            <a href="{{$cat->slug.'/'.$cat->slugbar}}">
                                            @endif
                                                <img src="{{asset('img/uploads/'.$cat->foto1)}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            @if(Session::has('search'))
                                            <a href="{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbar}}">
                                            @else
                                            <a href="{{$cat->slug.'/'.$cat->slugbar}}">
                                            @endif
                                                <img src="{{asset('img/uploads/'.$cat->foto2)}}" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @if(Session::has('search'))
                                    <a href="{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbar}}" class="invisible">
                                    @else
                                    <a href="{{$cat->slug.'/'.$cat->slugbar}}" class="invisible">
                                    @endif
                                    </a>
                                    <img src="{{asset('img/uploads/'.$cat->foto1)}}" alt="" class="img-responsive">
                                <div class="text">
                                    <h3>
                                        @if(Session::has('search'))
                                            <a href="{{$cat->bagian.'/'.$cat->slug.'/'.$cat->slugbar}}">
                                            @else
                                            <a href="{{$cat->slug.'/'.$cat->slugbar}}">
                                            @endif
                                    @if(strlen($cat->judul) >= 20 )
                                    {{substr($cat->judul, 0, 20)}}...
                                    @else
                                    {{$cat->judul}}
                                    @endif
                                    </a></h3>
                                    <p class="price">Rp.{{$angka_format = number_format($cat->harga,0,",",".")}}</p>
                                    @if(Auth::check() && Auth::user()->level == 'admin')
                                    <p class="text-center buttons">
                                    <a href="{{ route('get.update',$cat->id_barang) }}"><button class="btn btn-primary btn-block btn-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah Produk</button></a>


                                    <form id="delete-form-{{ $cat->id_barang }}" method="post" action="{{ route('destroy',$cat->id_barang) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    </form>
                                    <button class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#myModal{!! $cat->id_barang!!}"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Produk</button>

                                    <div class="modal fade" id="myModal{!! $cat->id_barang!!}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Anda yakin ingin menghapus <strong>{{ $cat->judul }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $cat->id_barang }}').submit();"><button type="submit" class="btn btn-danger">Hapus</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                    </p>
                                @elseif(Auth::check() && Auth::user()->level == 'users')
                                <form action="{{route('cart.store', ['bagian' => $cat->bagian,'slug' => $cat->slug,'slugbarang' => $cat->slugbar])}}" method="post"">
                                {{ csrf_field() }}
                                    <p class="buttons">
                                        <button type="submit" class="btn btn-primary btn-block"  name="submitbutton" value ="cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    </p>
                                </form>
                                @endif
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                          
                        </div>
                        @endforeach
                    </div>
                    <!-- /.products -->
                    <div class="pages">
                        
                        @if ($kategori->count() == 0)
                        <div class="box info-bar">
                        <div class="row">
                        <h2>Tidak ada produk yang dapat ditampilkan.</h2>
                        </div>
                        </div>
                        @endif
                        {{ $kategori->links() }}
                        
                                              
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->


  @endsection