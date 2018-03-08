@extends('layouts.app')
@section('main-content')
@section('title', 'Fashioneer')
<style type="text/css">
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
.tb_address {
    border-bottom:0px !important;
}
.tb_address th, .tb_address td {
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
#myProgress {
    width: 100%;
    background-color: #f7f7f7;
}
#myBar {
    width: 1%;
    height: 30px;
    background-color: #4fbfa8;
}
</style>
<div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="#">Home</a>
                        </li>
                        <li>Checkout</li>
                        <li id="breadcrumb">Alamat</li>
                    </ul>
                </div>

                <div class="col-md-9" id="checkout">

                    <div class="box">
                            <h1>Checkout</h1>
                            <ul class="nav nav-pills nav-justified">

                                <li id="li-tab1" class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-map-marker"></i><br>Alamat</a></li>
                                <li id="li-tab2"><a href="#tab2" data-toggle="tab"><i class="fa fa-truck"></i><br>Metode Pengiriman</a></li>
                                <li id="li-tab3"><a href="#tab3" data-toggle="tab"><i class="fa fa-money"></i><br>Metode Pembayaran</a></li>
                                <li id="li-tab4"><a href="#tab4" data-toggle="tab"><i class="fa fa-eye"></i><br>Order Review</a></li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">
                                    <div id="alert" style="display: none;">

                                    </div>
                                    <div class="content">
                                        @include('address')
                                    </div>

                                    <div class="box-footer">
                                        <div class="pull-left">
                                            <a href="{{route('cart')}}" id="back_cart" class="btn btn-default"><i class="fa fa-chevron-left"></i>Ke Keranjang</a>
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" id="order" data-value="Pengiriman" data-target="#li-tab2" class="btn btn-primary btnNext">Lanjutkan Pembelian<i class="fa fa-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab2">
                                    <div class="col-lg-12">
                                        <div id="myProgress" style="display: none;">
                                          <div id="myBar"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="error_msg">
                                      
                                    </div>
                                   <div class="row" id="shipment">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="kurir">Pilih Kurir</label><br>
                                            <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="kurir" required>
                                                <option id="courrier" selected>Pilih Kurir</option>
                                                <option value="jne">JNE</option>
                                                <option value="tiki">TIKI</option>
                                                <option value="pos">POS</option>
                                            </select>
                                            @if ($errors->has('kurir'))
                                                    <div class="alert alert-danger">
                                                    <strong>Error!</strong> {{ $errors->first('kurir') }}.
                                                    </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="service">Jenis Layanan</label><br>
                                            <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="services" disabled required>
                                                <option id="select_services" selected>Pilih Kurir Dahulu</option>
                                            </select>
                                            @if ($errors->has('service'))
                                                    <div class="alert alert-danger">
                                                    <strong>Error!</strong> {{ $errors->first('service') }}.
                                                    </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="panel panel-primary" id="detail_ship" style="display: none;">
                                  <div class="panel-heading"><h3 class="ship" id="head_ship"></h3></div>
                                  <div class="panel-body">
                                    <div class="col-lg-6"> 
                                        <table class="table tb_shipment" style="font-size: 18px;">
                                            <tbody>
                                                <tr style="border-bottom: #00BFA5 solid 2px;border-top: white solid;height: 69px;">
                                                    <td style="width: 153px;">Layanan</td>
                                                    <td>:</td>
                                                    <td class="ship" id="serv_ship"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr style="border-bottom: #00BFA5 solid 2px;border-top: white solid;height: 69px;">
                                                    <td style="width: 153px;">Berat</td>
                                                    <td>:</td>
                                                    <td class="ship" id="weight_ship"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                        <div class="col-lg-6"> 
                                          <table class="table tb_shipment" style="font-size: 18px;">
                                            <tbody>
                                                <tr style="border-bottom: #00BFA5 solid 2px;border-top: white solid;height: 69px;">
                                                    <td style="width: 153px;">Perkiraan</td>
                                                    <td>:</td>
                                                    <td class="ship" id="est_ship"></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr style="border-bottom: #00BFA5 solid 2px;border-top: white solid;height: 69px;">
                                                    <td style="width: 153px;">Biaya</td>
                                                    <td>:</td>
                                                    <td class="ship" id="ongkir_ship"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                  </div>
                                </div>
                                <div class="box-footer">
                                    <div class="pull-right">
                                            <button type="submit" id="payment" data-value="Pembayaran" data-target="#li-tab3" class="btn btn-primary btnNext">Lanjutkan Pembelian<i class="fa fa-chevron-right"></i>
                                            </button>
                                    </div>
                                    <div class="pull-left">
                                            <button type="submit" id="address" data-value="Alamat" data-target="#li-tab1" class="btn btn-default btnPrevious"><i class="fa fa-chevron-left"></i>Kembali
                                            </button>
                                    </div>
                                </div>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <a class="btn btn-primary btnPrevious" >Previous</a>
                                </div>
                            </div>
                            
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-md-9 -->

                <div class="col-md-3">

                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>Ringkasan Pesanan</h3>
                        </div>

                            <div class="order">

                                <p class="text-muted">Belum Termasuk Biaya Pengiriman dan Biaya Tambahan lainnya.</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Kuantitas</td>
                                                <th id="tb_qty">{{$all_cart[0]->count_qty}}</th>
                                            </tr>
                                            <tr>
                                                <td>Total Produk</td>
                                                <th id="tb_prd">{{$all_cart[0]->count_barang}} Produk</th>
                                            </tr>
                                            <tr class="total">
                                                <td>Total</td>
                                                <th id="tb_total">Rp{{number_format($all_cart[0]->count_total,0,",",".")}}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                    </div>

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript"> 
            $('#payment').attr( "disabled",true);
            $('#li-tab2').addClass( "disabled");
            $('#tab2').prop("disabled", true).off('click');
            $('#li-tab3').addClass( "disabled");
            $('#tab3').prop("disabled", true).off('click');
            $('#li-tab4').addClass( "disabled");
            $('#tab4').prop("disabled", true).off('click');
            $('#li-tab2,#tab2,#li-tab3,#li-tab4,#tab4,#payment').click(function(event){
                if ($(this).hasClass('disabled')) {
                    return false;
                }
            });
    if ($('#add_address').length) {
            $('#order').attr( "disabled",true);
            $('#order,#li-tab2,#tab2,#li-tab3,#li-tab4').click(function(event){
                if ($(this).hasClass('disabled')) {
                    return false;
                }
            });
        }

    if ($('#change_address').length) {
            $('#li-tab3').addClass( "disabled");
            $('#li-tab4').addClass( "disabled");
            $('#li-tab2,#tab2,#li-tab3,#li-tab4').click(function(event){
                if ($(this).hasClass('disabled')) {
                    return false;
                }
            });
        }

    $(document).ready(function(){
         $('.btnNext').click(function(){
            var value = $(this).data("value");
            var target = $(this).data("target");
            $(target).removeClass( "disabled");
            $('html, body').animate({ scrollTop: $('.breadcrumb').offset().top }, 'slow');
            $('#breadcrumb').empty();
            $('#breadcrumb').text(value);
            $('.nav-pills > .active').next('li').find('a').trigger('click');
        });

          $('.btnPrevious').click(function(){
            var value = $(this).data("value");
            var target = $(this).data("target");
            $('html, body').animate({ scrollTop: $('.breadcrumb').offset().top }, 'slow');
            $('#breadcrumb').empty();
            $('#breadcrumb').text(value);
          $('.nav-pills > .active').prev('li').find('a').trigger('click');
        });

        $("#kurir").change(function(){
            $('#services').empty();
            $('#detail_ship').hide();
            $('#shipment').hide();
            $('#courrier').remove();
            $('#myProgress').show( "fast", function() {
                  width = 1;
                  id = setInterval(frame, 10);
                  function frame() {
                    if (width >= 100) {
                      clearInterval(id);
                    } else {
                      width++; 
                      $("#myBar").css("width", width+"%");
                    }
                  }
              });
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                type: "POST",
                url: "{{route('ongkir')}}",
                data: {kurir : $("#kurir").val(), type : "kurir"},
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                      e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){
                    $('#myProgress').hide();
                    $(".loader").hide();
                    $("#services").removeAttr('disabled');
                    if(response['rajaongkir']['status']['code'] == "200"){
                        $('#select_services').remove();
                        $("#services").append($('<option id="select_services" selected>Pilih Layanan</option>'));
                        for (var i=0; i < response['rajaongkir']['results'].length; i++) {
                        for (var j=0; j < response['rajaongkir']['results'][i]['costs'].length; j++) {
                          $('#services').append($('<option value="'+response['rajaongkir']['results'][i]['costs'][j]['service']+'" data-subtext="'+response['rajaongkir']['results'][i]['costs'][j]['description']+'">'+response['rajaongkir']['results'][i]['costs'][j]['service']+'</option>'));
                        }
                        }
                    }else{
                        $("#kurir").append($('<option id="courrier" selected>Pilih Kurir Dahulu</option>'));
                        $('#error_msg').css("opacity", "");
                        $('#error_msg').show();
                        $('#error_msg').html('<div class="alert alert-danger fade in alert-dismissable"><strong>'+response['rajaongkir']['status']['description']+'</strong></div>');
                        window.setTimeout(function() {
                        $('#error_msg').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
                    }
                    $('.selectpicker').selectpicker('refresh');
                    $('.selectpicker').selectpicker('show');
                    $('#shipment').show();
                    },
                  error: function (response) {
                    $('#myProgress').hide();
                    $('.selectpicker').selectpicker('refresh');
                    $('#shipment').show();
                    $('#error_msg').append($('<div class="alert alert-danger fade in alert-dismissable"><strong>'+response['rajaongkir']['status']['description']+'</strong></div>'));
                        window.setTimeout(function() {
                        $('#error_msg').fadeTo(500, 0).slideUp(600, function(){
                            $(this).empty(); 
                        });
                    }, 4000); 
                  }
        });
    });

    //services
    $("#services").change(function(){
            $('#select_services').remove();
            $('.selectpicker').selectpicker('refresh');
            $('#shipment').hide();
            $('#detail_ship').hide();
            $('#myProgress').show( "fast", function() {
                  width = 1;
                  id = setInterval(frame, 10);
                  function frame() {
                    if (width >= 100) {
                      clearInterval(id);
                    } else {
                      width++; 
                      $("#myBar").css("width", width+"%");
                    }
                  }
              });
            $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
            $.ajax({
                type: "POST",
                url: "{{route('ongkir')}}",
                data: {kurir : $("#kurir").val(), type : "kurir"},
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                      e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){
                    $('#shipment').show();
                    $('#myProgress').hide();
                    $(".loader").hide();
                    $("#services").removeAttr('disabled');
                    if(response['rajaongkir']['status']['code'] == "200"){
                        
                        for (var y=0; y < response['rajaongkir']['results'].length; y++) {
                        for (var x=0; x < response['rajaongkir']['results'][y]['costs'].length; x++) {
                                value =  $("#services").val();
                                kurir =  $("#kurir").val();
                                $('#select_services').remove();
                                
                                if (response['rajaongkir']['results'][y]['costs'][x]['service'] == value) {
                                $('.ship').empty();
                                $('#head_ship').text(response['rajaongkir']['results'][y]['name']);
                                $('#serv_ship').text(response['rajaongkir']['results'][y]['costs'][x]['service']);
                                $('#weight_ship').text(response['rajaongkir']['query']['weight']+'gram');
                                if(kurir === "pos" ){
                                    $('#est_ship').text(response['rajaongkir']['results'][y]['costs'][x]['cost'][0]['etd']);
                                }else{
                                    $('#est_ship').text(response['rajaongkir']['results'][y]['costs'][x]['cost'][0]['etd']+' Hari');
                                }
                                $('#ongkir_ship').text("Rp"+addCommas(response['rajaongkir']['results'][y]['costs'][x]['cost'][0]['value']));
                                $('#detail_ship').show();
                                $('#payment').removeAttr( "disabled",true);
                                }
                        }
                        }
                    }else{
                        $("#services").append($('<option id="select_services" selected>Pilih Layanan</option>'));
                        $('#error_msg').css("opacity", "");
                        $('#error_msg').show();
                        $('#error_msg').html('<div class="alert alert-danger fade in alert-dismissable"><strong>'+response['rajaongkir']['status']['description']+'</strong></div>');
                        window.setTimeout(function() {
                        $('#error_msg').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
                    }
                    $('#shipment').show();
                    },
                  error: function (response) {
                    $("#services").append($('<option id="select_services" selected>Pilih Layanan</option>'));
                    $('#shipment').show();
                    $('#myProgress').hide();
                    $('.selectpicker').selectpicker('refresh');
                    $('#shipment').show();
                    
                    $('#error_msg').append($('<div class="alert alert-danger fade in alert-dismissable"><strong>'+response['rajaongkir']['status']['description']+'</strong></div>'));
                        window.setTimeout(function() {
                        $('#error_msg').fadeTo(500, 0).slideUp(600, function(){
                            $(this).empty(); 
                        });
                    }, 4000); 
                  }
        });
    });
    });
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
@endsection