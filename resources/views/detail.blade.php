@extends('layouts.app')
@section('main-content')
@section('title', $product[0]->judul)
<style type="text/css">
.table-bordered {
    border-bottom:0px !important;
}
.table-bordered th, .table-bordered td {
    border: 1px !important;
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

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li><a href="{{route('show_kat', ['bagian' => $allcat[0]->bagian])}}"> {{$allcat[0]->bagian}}</a></li>
                        <li><a href="{{route('show_sub', ['bagian' => $allcat[0]->bagian,'slug' => $product[0]->nama_kat])}}">
                        {{$product[0]->nama_kat}}</a></li>
                        <li>
                            @if(strlen($product[0]->judul) >= 15 )
                                    {{substr($product[0]->judul, 0, 15)}}...
                                    @else
                                    {{$product[0]->judul}}
                                    @endif
                        </li>
                    </ul>
                </div>
                


                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">
                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li class="active">
                                    <a href="../">{{$allcat[0]->bagian}}</a>
                              @foreach($allcat as $cat)
                              
                                    <ul>
                                        <li><a href="../{{$cat->nama_kat}}">{{$cat->nama_kat}}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                            
                            </ul>

                        </div>
                    </div>


                    <!-- *** MENUS AND FILTERS END *** -->
                </div>
                @foreach($product as $prd)
                <div class="col-md-9">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage">
                                <img src="{{asset('img/uploads/'.$prd->foto1)}}" alt="" class="img-responsive">
                            </div>
                        <div class="row" id="thumbs" style="margin-top: 17px;margin-bottom: 13px;">
                                <div class="col-xs-4">
                                    <a href="{{asset('img/uploads/'.$prd->foto1)}}" class="thumb">
                                        <img src="{{asset('img/uploads/'.$prd->foto1)}}" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="{{asset('img/uploads/'.$prd->foto2)}}" class="thumb">
                                        <img src="{{asset('img/uploads/'.$prd->foto2)}}" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="{{asset('img/uploads/'.$prd->foto3)}}" class="thumb">
                                        <img src="{{asset('img/uploads/'.$prd->foto3)}}" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="box" style="padding: inherit;height: 399px;max-height: 399px;">
                                <h2 class="text-center">

                                @if(strlen(str_replace(' ','',$prd->judul)) >= 27 )
                                    {{substr($prd->judul, 0, 24)}}...
                                    @else
                                    {{$prd->judul}}
                                    @endif
                                </h2>

                                <p class="price">Rp.{{$angka_format = number_format($prd->harga,0,",",".")}}</p>

                                @if(Auth::check() && Auth::user()->level == 'admin')
                                    <br>
                                    <br>
                                    <p class="text-center buttons">
                                    <a href="{{ route('get.update',$prd->id_barang) }}"><button class="btn btn-primary btn-block btn-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Ubah Produk</button></a>


                                    <form id="delete-form-{{ $prd->id_barang }}" method="post" action="{{ route('destroy',$prd->id_barang) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    </form>
                                    <button class="btn btn-danger btn-block btn-lg" data-toggle="modal" data-target="#myModal{!! $prd->id_barang!!}"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Produk</button>

                                    <div class="modal fade" id="myModal{!! $prd->id_barang!!}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Anda yakin ingin menghapus <strong>{{ $prd->judul }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $prd->id_barang }}').submit();"><button type="submit" class="btn btn-danger">Hapus</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                    </p>
                                @else
                                <form action="" method="post"">
                                {{ csrf_field() }}
                                <div style="margin: 23px 0px;">
                                <span class="input-number-decrement"><i class="fa fa-minus" aria-hidden="true"></i></span><input class="input-number" type="text" value="1" min="1" max="{{$prd->stok}}" name="qty" id="qty" style="width: 83%;"><span class="input-number-increment"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                @if ($errors->has('qty'))
                                <div class="alert alert-danger" style="padding: 8px 16px;width: 99%;">
                                <strong>Error!</strong> {{ $errors->first('qty') }}
                                </div>
                                @endif
                                </div>
                                
                                <p class="text-center buttons">
                                    
                                    <button class="btn btn-primary btn-block btn-lg"><i class="fa fa-shopping-cart" name="buy"></i> Beli Sekarang</button>

                                <div class="row">
                                <div class="col-sm-6 col-xs-6">

                                    <button type="submit" class="btn btn-default btn-block"  name="submitbutton" value ="cart"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                </form>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                <form  method="post" action="#">
                                    {{ csrf_field() }}
                                    <button  class="btn btn-default btn-block"><i class="fa fa-heart"></i> Add to wishlist</button>
                                    </form>
                                </div>
                                </div>
                                </p>
                                @endif

                            </div>
                            <div class="box" style="padding: inherit;margin: -15px -2px;height: 117px;">
                                <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                            <td><strong>Dilihat</strong></td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{ Counter::showAndCount('detail'.$prd->id_barang) }}x</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tersedia</strong></td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{$prd->stok}} Stok</strong></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Berat per Barang</strong></td>
                                            <td><strong>:</strong></td>
                                            <td><strong>{{$prd->berat}}gr</strong></td>
                                        </tr>
                                      </thead>
                                </table>
                            </div>
                            
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h3>Product details</h3><hr>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                           Product 
                                        </td>
                                        <td>
                                           :
                                        </td>
                                        <td>
                                            <strong>{{$prd->judul}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                           Category 
                                        </td>
                                        <td>
                                           :
                                        </td>
                                        <td>
                                            <strong>{{$prd->nama_kat.' '.$prd->bagian}}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <blockquote>
                                <p>{{$prd->deskripsi}}
                                </p>
                            </blockquote>


                            <hr>
                            <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div>
                    </div>
                   </div>
                   @endforeach 
</div>
<script type="text/javascript">
(function() {
  window.inputNumber = function(el) {
    var min = el.attr("min") || false;
    var max = el.attr("max") || false;

    var els = {};

    els.dec = el.prev();
    els.inc = el.next();

    el.each(function() {
      init($(this));
    });

    function init(el) {
      els.dec.on("click", decrement);
      els.inc.on("click", increment);

      function decrement() {
        var value = el[0].value;
        value--;
        if (!min || value >= min) {
          el[0].value = value;
        }
      }

      function increment() {
        var value = el[0].value;
        value++;
        if (!max || value <= max) {
          el[0].value = value++;
        }
      }
    }
  };
})();

inputNumber($(".input-number"));

</script>
@endsection