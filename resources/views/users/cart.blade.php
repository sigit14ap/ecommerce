@extends('layouts.app')
@section('main-content')
@section('title', 'Keranjang Belanja')
<style type="text/css">
label.btn span {
  font-size: 1.5em ;
}
    label input[type="checkbox"] ~ i.fa.fa-square-o{
    color: #c8c8c8;    display: inline;
}
label input[type="checkbox"] ~ i.fa.fa-check-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
    color: #7AA3CC;    display: inline;
}
label:hover input[type="checkbox"] ~ i.fa {
color: #7AA3CC;
}

div[data-toggle="buttons"] label.active{
    color: #7AA3CC;
}

div[data-toggle="buttons"] label {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: normal;
line-height: 2em;
text-align: left;
white-space: nowrap;
vertical-align: top;
cursor: pointer;
background-color: none;
border: 0px solid 
#c8c8c8;
border-radius: 3px;
color: #c8c8c8;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

div[data-toggle="buttons"] label:hover {
color: #7AA3CC;
}

div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
-webkit-box-shadow: none;
box-shadow: none;
}
.loader {
  border: 3px solid #f3f3f3;
  border-radius: 50%;
  border-top: 3px solid blue;
  border-bottom: 3px solid blue;
  width: 50px;
  height: 50px;
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
                        <li>Keranjang Belanja</li>
                    </ul>
                </div>

                @if(Session::has('err_msg'))
                <div class="col-md-12">
                  <div class="alert alert-danger fade in alert-dismissable">
                    <strong>{{ Session::get('err_msg') }}</strong>
                  </div>
                </div>
                @endif

                @if(Session::has('success_msg'))
                    <div class="col-md-12">
                                    <div class="box">
                                    <div class="container">
                                        <div class="col-md-12">
                                            <h2> <i class="fa fa-check fa-lg" aria-hidden="true"></i>&nbsp;{{ Session::get('success_msg') }}</h2>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    @endif
                <div class="col-md-9" id="basket">

                    <div class="box">

                            <h1>Keranjang Belanja</h1>
                            <p class="text-muted">
                            @if(is_null($count))
                              Keranjang anda masih kosong.
                            @else
                              Anda Mempunyai <strong>{{$count}}</strong> barang di keranjang belanja.</p>
                            @endif
                            @if ($errors->has('qty'))
                            <div class="alert alert-danger" style="padding: 8px 16px;width: 99%;">
                            <strong>Error!</strong> Kuantiti harus angka diantara 1 dan 1000.
                            </div>
                            @endif
                            @if($count == 0)
                            <hr>
                            <center>
                                <h3>Keranjang Anda Kosong</h3>
                                <a href="{{route('home')}}" class="btn btn-default"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Lanjutkan Belanja</a>
                            </center>
                            <hr>
                            @else
                            @foreach($cart as $cart2)
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <div class="btn-group btn-group" id="prd-check" data-id="{{$cart2->id}}" data-toggle="buttons">
                                        @if($cart2->status == 1)
                                        <label class="btn active">
                                          <input type="checkbox" name='product' checked>
                                        @else
                                        <label class="btn">
                                          <input type="checkbox" id="checkbox" name='product'>
                                        @endif
                                          <i class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i><span>
                                            @if(strlen(str_replace(' ', '', $cart2->judul)) >= 20 )
                                            {{substr($cart2->judul, 0, 20)}}...
                                            @else
                                            {{$cart2->judul}}
                                            @endif
                                        </label>
                                    </div>
                                    <div style="float: right;">
                                    <form id="delete-form-{{ $cart2->id }}" method="post" action="{{ route('destroy.cart',$cart2->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                </form>
                                                <button class="btn btn-default" data-toggle="modal" data-target="#myModal{!! $cart2->id!!}"><i class="fa fa-times fa-lg" aria-hidden="true"></i></button>
                                        <div class="modal fade" id="myModal{!! $cart2->id!!}" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Hapus</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Hapus <strong>{{ $cart2->judul }}</strong> dari keranjang ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" onclick="event.preventDefault();document.getElementById('delete-form-{{ $cart2->id }}').submit();"><button type="submit" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Hapus</button></a>
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
                                        <a href="../{{$cart2->bagian.'/'.$cart2->slug.'/'.$cart2->slugbar}}">
                                                <img src="{{asset('img/uploads/'.$cart2->foto1)}}" class="media-object" style="width:80px">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading" style="float: left;height: 15px">
                                      <a href="../{{$cart2->bagian.'/'.$cart2->slug.'/'.$cart2->slugbar}}">
                                        <p style="color: black;">@if(strlen(str_replace(' ', '', $cart2->judul)) >= 40 )
                                            {{substr($cart2->judul, 0, 40)}}...
                                        @else
                                            {{$cart2->judul}}
                                        @endif</p>
                                      </a>
                                      </h4>
                                      <h4 class="media-heading" style="float: right;">
                                        <p id="total{{$cart2->id}}">Rp{{number_format($cart2->total,0,",",".")}}</p>
                                      </h4><br>
                                      <div class="loader" style="margin: 10px 10px;" id="load{{$cart2->id}}"></div>

                                            <div style="margin: 23px 0px;" id="div{{$cart2->id}}">
                                            <button id="decrement" data-product="{{$cart2->id}}" class="input-number-decrement"><i class="fa fa-minus" aria-hidden="true"></i></button><input class="input-number"  type="number" min="1" name="qty" id="qty{{$cart2->id}}" value="{{$cart2->qty}}" style="width: 80px;"><button class="input-number-increment" id="increment" data-product="{{$cart2->id}}"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                    </div>
                                    <div id="error{{$cart2->id}}">
                                        

                                    
                                    </div>
                                  </div>
                                  </div>
                                </div>
                                @endforeach
                                @endif
                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="{{route('home')}}" class="btn btn-default"><i class="fa fa-chevron-left"></i> Lanjutkan Belanja</a>
                                </div>
                            </div>

                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->
                @if($count == 0)
                <div class="col-md-3">
                </div>
                @else
                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Ringkasan Pesanan</h3>
                        </div>
                            <div id="loading">
                                <center>
                                <div class="loader" style="margin: 10px 10px;width: 100px;height: 100px;" id="animation_load"></div>
                                </center>
                            </div>
                            <form id="formCheckout" method="post" action="{{ route('checkout') }}">
                                        {{ csrf_field() }}
                                </form>
                                        <div class="modal fade" id="modalCheckout" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Checkout</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Produk yang dipilih akan dihapus dari keranjang , ingin melanjutkan ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                                <a href="" onclick="event.preventDefault();document.getElementById('formCheckout').submit();">
                                                <button type="submit" class="btn btn-primary">Lanjutkan<i class="fa fa-chevron-right"></i></button></a>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                            <div class="order">
                                @if($sum[0]->count_status == 0)
                                <h4>Pilih produk dahulu sebelum checkout</h4>
                                @else
                                <p class="text-muted">Belum Termasuk Biaya Pengiriman dan Biaya Tambahan lainnya.</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Kuantitas</td>
                                                <th id="tb_qty">{{$sum[0]->count_qty}}</th>
                                            </tr>
                                            <tr>
                                                <td>Total Produk</td>
                                                <th id="tb_prd">{{$sum[0]->count_barang}} Produk</th>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <th id="tb_total">Rp{{number_format($sum[0]->count_total,0,",",".")}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" id="checkout" data-toggle="modal" data-target="#modalCheckout" class="btn btn-primary btn-lg btn-block">Checkout&nbsp;<i class="fa fa-chevron-right"></i></button>

                                @endif
                            </div>
                    </div>


                </div>
                <!-- /.col-md-3 -->
                @endif
                

            </div>
            <!-- /.container -->
@if($count >= 1)
<meta name="csrf-token" content="{{ csrf_token() }}">            
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
$('#decrement, #increment,.input-number').hide();
$('.order').hide();
$(document).ready(function(){
    $('.loader').hide();
    $('#loading').hide();
    $('.order').show();
    $('#prd-check, #label-check').click(function(){
        var product_id  = $(this).data("id");
        $('#checkbox').attr("disabled", true).off('click');
        $('#loading').show();
        $('#animation_load').show();
        $('.order').hide();
        $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

        $.ajax({
                type: "POST",
                url: "{{route('cart.checked')}}",
                data: {id : product_id},
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                      e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){
                    $('.order').show();
                    $('#loading').hide();
                    $('#animation_load').hide();
                    $('#tb_qty').empty();
                    $('#tb_prd').empty();
                    $('#tb_total').empty();
                    if (response["cart"][0]["count_barang"] === 0) {
                        $('.order').empty();
                        $('.order').html('<h4>Pilih produk dahulu sebelum checkout</h4>');
                    }else{
                        $('.order').html('<p class="text-muted">Belum Termasuk Biaya Pengiriman dan Biaya Tambahan lainnya.</p><div class="table-responsive"><table class="table"<tbody><tr><td>Kuantitas</td><th id="tb_qty"></th></tr><tr><td>Total Produk</td><th id="tb_prd"> Produk</th></tr><tr class="total"><td>Total</td><th id="tb_total">Rp</th></tr></tbody></table></div><button type="submit" id="checkout" data-toggle="modal" data-target="#modalCheckout" class="btn btn-primary btn-lg btn-block">Checkout&nbsp;<i class="fa fa-chevron-right"></i></button>')
                    }
                        $('#tb_qty').text(response["cart"][0]["count_qty"]);
                        $('#tb_prd').text(response["cart"][0]["count_barang"] + ' Produk');
                        $('#tb_total').text('Rp'+addCommas(response["cart"][0]["count_total"]));
                    },
                  error: function (response) {
                    $('.order').show();
                    $('#loading').hide();
                    $('#animation_load').hide();
                    if(response.status === 400) {
                        alert(response.responseJSON.error);
                    } 
                  }
        });
    });


    $('#decrement, #increment,.input-number').show();
    $('#decrement, #increment').click(function(){
        
        var product_id    = $(this).data("product");
        var qty     = $('#qty' + product_id).val();
        var load    = $('#load' + product_id);
        $('#load' + product_id).show();
        $('#div' + product_id).hide();
        $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
        $.ajax({
                type: "POST",
                url: "{{route('cart.update')}}",
                data: {id : product_id,qty : qty},
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                      e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){
                    $('#load' + product_id).hide();
                    $('#div' + product_id).show();
                    $('#total' + product_id).empty();
                    $('#tb_qty').empty();
                    $('#tb_total').empty();
                        $('#total' + product_id).text('Rp'+addCommas(response["cart"][0]["total"]));
                        $('#tb_qty').text(response["total"][0]["count_qty"]);
                        $('#tb_total').text('Rp'+addCommas(response["total"][0]["count_total"]));
                    },
                  error: function (response) {
                  $('#load' + product_id).hide();
                  $('#div' + product_id).show();
                    if(response.status === 400) {
                        $('#qty' + product_id).val(response.responseJSON["cart"][0]["qty"]);
                        $('#error' + product_id).html('<div class="alert alert-danger" role="alert" id=alert'+product_id+'><strong>'+ response.responseJSON["name"] + ' Hanya Tersedia '+ response.responseJSON["maks"] + ' Stok </strong></div>');
                    }else if(response.status === 403) {
                        $('#qty' + product_id).val(response.responseJSON["cart"][0]["qty"]);
                        $('#error' + product_id).html('<div class="alert alert-danger" role="alert" id=alert'+product_id+'><strong>'+ response.responseJSON["message"] +'</strong></div>');
                    }
                    window.setTimeout(function() {
                        $('#alert' + product_id).fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 4000); 
                  }
    });
    });
  });
@foreach($cart as $cart2)
inputNumber($("#qty{{$cart2->id}}"));
@endforeach
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
</script>
@endif
@endsection