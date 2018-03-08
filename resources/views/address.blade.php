<div id="include">

	@if(is_null($address))
					<center>
		         	<h3>Belum ada alamat.</h3>
		         	<button class="btn btn-default btn-lg" id="add_address" data-toggle="modal" data-target="#myModal"><i class="fa fa-map-marker" aria-hidden="true"></i>Tambahkan Alamat</button>
		         	</center>
		         	<div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Tambah Alamat</h4>
                                            </div>
                                            <div class="modal-body">
                                            	<div class="alert alert-warning">
                                            	@if(Auth::user()->level == "users")
												  <strong><i class="fa fa-exclamation" aria-hidden="true"></i> Kesalahan data adalah tanggung jawab pengguna.</strong>
												@else
												<strong><i class="fa fa-exclamation" aria-hidden="true"></i> Alamat Anda Akan dijadikan perhitungan ongkos kirim.</strong>
												@endif
												</div>
					                        	<div class="form-group">
					                                <label for="judul">Jenis Alamat</label>
					                                <input type="text" class="form-control" id="jenis_alamat" placeholder="Rumah, kantor, kost , atau lainnya" required>
					                                @if ($errors->has('jenis_alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('jenis_alamat') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">Atas Nama</label>
					                                <input type="text" class="form-control" id="nama" placeholder="Atas Nama" required>
					                                @if ($errors->has('nama'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('nama') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">No. Telepon</label>
					                                <input type="number" class="form-control" id="telepon" placeholder="08XXXXX" required>
					                                @if ($errors->has('telepon'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('telepon') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="provinsi">Provinsi</label><br>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="provinsi" name="provinsi" required>
					                                	<option id="prov" selected>Pilih Provinsi</option>
					                                @foreach($wilayah as $wil)
					                                <option value="{{$wil->province_id}}">{{$wil->province}}</option>
					                                @endforeach
					                                </select>
					                                @if ($errors->has('provinsi'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('provinsi') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="kota">Kota/Kabupaten</label><br>
					                                <center><div class="loader"></div></center>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="city" name="kota" disabled required>
					                                	<option id="select_kota" selected>Pilih Provinsi Dahulu</option>
					                                </select>
					                                @if ($errors->has('kota'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('kota') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="deskripsi">Alamat Lengkap</label>
					                                <textarea class="form-control" rows="5" id="alamat" placeholder="Alamat Lengkap. . ." required></textarea>
					                                @if ($errors->has('alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('alamat') }}.
					                                </div>
					                                @endif
					                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="submit" type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Simpan</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                <hr>

    @endif
    @if(Auth::user()->level == "users" && !is_null($address))
                    	<div class="alert alert-warning">
                                      <strong><i class="fa fa-exclamation" aria-hidden="true"></i></strong> Kesalahan data adalah tanggung jawab pengguna.
                        </div>
                    	<div class="panel panel-default">
                    		<div class="panel-body">
	                    		<table class="table table-bordered tb_address" style="table-layout: fixed;">
	                                <tbody>
	                                    <tr class="border_bottom">
	                                        <td>
	                                           <h4>Jenis Alamat</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="jenis">
	                                            <h4><strong>{{$address->jenis_alamat}}</strong></h4>
	                                        </td>
	                                    </tr>
	                                    <tr class="border_bottom">
	                                        <td>
	                                           <h4>Atas Nama</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="an">
	                                            <h4><strong>{{$address->nama}}</strong></h4>
	                                        </td>
	                                    </tr>
	                                    <tr class="border_bottom">
	                                        <td>
	                                           <h4>No. Telepon</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="telp">
	                                            <h4><strong>{{$address->telepon}}</strong></h4>
	                                        </td>
	                                    </tr>
	                                    <tr class="border_bottom">
	                                        <td id="tipe_city">
	                                           <h4>{{$address->type}}</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="kota">
	                                            <h4><strong>{{$address->city_name}}</strong></h4>
	                                        </td>
	                                    </tr>
	                                    <tr class="border_bottom">
	                                        <td>
	                                           <h4>Provinsi</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="provinsi_tb">
	                                            <h4><strong>{{$address->province}}</strong></h4>
	                                        </td>
	                                    </tr>
	                                    <tr>
	                                        <td>
	                                           <h4>Alamat Lengkap</h4>
	                                        </td>
	                                        <td>
	                                           <h4>:</h4>
	                                        </td>
	                                        <td id="full_address">
	                                        	<div style="max-width: 70%;word-wrap:break-word;">
	                                            <h4><strong>{{$address->alamat}}</strong></h4>
	                                        	</div>
	                                        </td>
	                                    </tr>
	                                </tbody>
	                            </table>
	                        </div>
	                        <div class="panel-footer"><button type="button" id="change_address" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal2"><i class="fa fa-map-marker" aria-hidden="true"></i>Ubah Alamat</button></div>
	                    </div>
                	
                    		<div class="modal fade" id="myModal2" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Ubah Alamat</h4>
                                            </div>
                                            <div class="modal-body">
                                            	<div class="alert alert-warning">
												  <strong><i class="fa fa-exclamation" aria-hidden="true"></i> Kesalahan data adalah tanggung jawab pengguna.</strong>
												</div>
					                        	<div class="form-group">
					                                <label for="judul">Jenis Alamat</label>
					                                <input type="text" class="form-control" id="jenis_alamat" placeholder="Rumah, kantor, kost , atau lainnya" value="{{$address->jenis_alamat}}" required>
					                                @if ($errors->has('jenis_alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('jenis_alamat') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">Atas Nama</label>
					                                <input type="text" class="form-control" id="nama" placeholder="Atas Nama" value="{{$address->nama}}" required>
					                                @if ($errors->has('nama'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('nama') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">No. Telepon</label>
					                                <input type="number" class="form-control" id="telepon" value="{{$address->telepon}}" placeholder="08XXXXX" required>
					                                @if ($errors->has('telepon'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('telepon') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="provinsi">Provinsi</label><br>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="provinsi" name="provinsi">
					                                @foreach($wilayah as $wil)
					                                @if($wil->province_id == $address->id_provinsi)
					                                <option value="{{$wil->province_id}}" selected>{{$wil->province}}</option>
					                                @else
					                                <option value="{{$wil->province_id}}">{{$wil->province}}</option>
					                                @endif
					                                @endforeach
					                                </select>
					                                @if ($errors->has('provinsi'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('provinsi') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="kota">Kota/Kabupaten</label><br>
					                                <center><div class="loader"></div></center>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="city" name="kota">
					                                @foreach($city as $kota)
					                                @if($kota->province_id == $address->id_provinsi)
						                                @if($kota->city_id == $address->id_kota)
						                                <option value="{{$kota->city_id}}" selected>{{$kota->type.' '.$kota->city_name}}</option>
						                                @else
						                                <option value="{{$kota->city_id}}">{{$kota->type.' '.$kota->city_name}}</option>
						                                @endif
						                            @endif
					                                @endforeach
					                                </select>
					                                @if ($errors->has('kota'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('kota') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="deskripsi">Alamat Lengkap</label>
					                                <textarea class="form-control" rows="5" id="alamat" placeholder="Alamat Lengkap. . ." required>{{$address->alamat}}</textarea>
					                                @if ($errors->has('alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('alamat') }}.
					                                </div>
					                                @endif
					                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="submit" data-id="{{$address->id_profile}}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Simpan</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
    @endif
    @if(Auth::user()->level == "admin")
    		<h3>Daftar Alamat Admin</h3>
                		<p class="text-muted">Alamat ini digunakan untuk perhitungan ongkos kirim.</p>
                		@foreach($admin as $addr)
                		@if($addr->status == "active")
                		<div class="panel panel-primary">
                		@else
                		<div class="panel panel-default">
                		@endif
                                  <div class="panel-heading">
                                  	<div style="max-width: 70%;word-wrap:break-word;">
                                    <h4>Admin {{$addr->nama}}</h4>
                                	</div>
                                    <div style="float: right;margin: -37px 9px;">
                                    @if($addr->status == "active")
                                    <button class="btn btn-primary"><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i>Terpilih</button>
                                    @else
                                        <button class="btn btn-default" data-toggle="modal" data-target="#modal10"><i class="fa fa-square-o fa-lg" aria-hidden="true"></i>Pilih</button>
                                        <div class="modal fade" id="modal10" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Pilih</h4>
                                            </div>
                                            <div class="modal-body">
                                              <p>Jadikan alamat Admin <strong>{{$addr->nama}}</strong> sebagai alamat utama ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="pilih" data-id="{{$addr->id_profile}}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Pilih</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                    @endif
                                    </div>
                                </div>
                                  <div class="panel-body">
                                  <div class="media">
                                    <div class="media-body">
                                    <h4>
	                                    <div class="col-lg-6"> 
	                                      Nama : {{$addr->nama}}<hr>
	                                      Telepon : {{$addr->telepon}}<hr>
	                                    </div>
	                                    <div class="col-lg-6"> 
	                                      Kota/Kabupaten : {{$addr->city_name}}<hr>
	                                      Provinsi : {{$addr->province}}<hr>
	                                    </div>
                                	</h4>
                                    </div>
                                  </div>
                                  </div>
                                  @if($addr->id_user == Auth::id())
                                  <div class="panel-footer"><button type="button" id="change_address" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#myModal2"><i class="fa fa-map-marker" aria-hidden="true"></i>Ubah Alamat Anda</button></div>

                                  <div class="modal fade" id="myModal2" role="dialog">
                                        <div class="modal-dialog">
                                        
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                              <h4 class="modal-title">Ubah Alamat</h4>
                                            </div>
                                            <div class="modal-body">
                                            	<div class="alert alert-warning">
												  <strong><i class="fa fa-exclamation" aria-hidden="true"></i> Kesalahan data adalah tanggung jawab pengguna.</strong>
												</div>
					                        	<div class="form-group">
					                                <label for="judul">Jenis Alamat</label>
					                                <input type="text" class="form-control" id="jenis_alamat" placeholder="Rumah, kantor, kost , atau lainnya" value="{{$address->jenis_alamat}}" required>
					                                @if ($errors->has('jenis_alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('jenis_alamat') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">Atas Nama</label>
					                                <input type="text" class="form-control" id="nama" placeholder="Atas Nama" value="{{$address->nama}}" required>
					                                @if ($errors->has('nama'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('nama') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="judul">No. Telepon</label>
					                                <input type="number" class="form-control" id="telepon" value="{{$address->telepon}}" placeholder="08XXXXX" required>
					                                @if ($errors->has('telepon'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('telepon') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="provinsi">Provinsi</label><br>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="provinsi" name="provinsi">
					                                @foreach($wilayah as $wil)
					                                @if($wil->province_id == $address->id_provinsi)
					                                <option value="{{$wil->province_id}}" selected>{{$wil->province}}</option>
					                                @else
					                                <option value="{{$wil->province_id}}">{{$wil->province}}</option>
					                                @endif
					                                @endforeach
					                                </select>
					                                @if ($errors->has('provinsi'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('provinsi') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="kota">Kota/Kabupaten</label><br>
					                                <center><div class="loader"></div></center>
					                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" id="city" name="kota">
					                                @foreach($city as $kota)
					                                @if($kota->province_id == $address->id_provinsi)
						                                @if($kota->city_id == $address->id_kota)
						                                <option value="{{$kota->city_id}}" selected>{{$kota->type.' '.$kota->city_name}}</option>
						                                @else
						                                <option value="{{$kota->city_id}}">{{$kota->type.' '.$kota->city_name}}</option>
						                                @endif
						                            @endif
					                                @endforeach
					                                </select>
					                                @if ($errors->has('kota'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('kota') }}.
					                                </div>
					                                @endif
					                            </div>
					                            <div class="form-group">
					                                <label for="deskripsi">Alamat Lengkap</label>
					                                <textarea class="form-control" rows="5" id="alamat" placeholder="Alamat Lengkap. . ." required>{{$address->alamat}}</textarea>
					                                @if ($errors->has('alamat'))
					                                <div class="alert alert-danger">
					                                <strong>Error!</strong> {{ $errors->first('alamat') }}.
					                                </div>
					                                @endif
					                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="submit" data-id="{{$address->id_profile}}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>Simpan</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                                            </div>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    <!-- END Modal -->
                                  @endif
                                </div>
                            @endforeach
                        </div>
                        <div>
    @endif
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
	var token = $('meta[name="csrf-token"]').attr('content');
$(".loader").hide();
$(document).ready(function(){

		$(document).on('click','#change_address',function(){
			$('.selectpicker').selectpicker('refresh');
			$(".loader").hide();
		});
		$(document).on('change','#provinsi',function(){
			$('.selectpicker').selectpicker('hide');
			$("#prov").remove();
			$("#select_kota").remove();
			$("#city").empty();
			$(".loader").show();

			$.ajaxSetup({
			    headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
			$.ajax({
				type: "POST",
				url: "{{route('get.city')}}",
				data: {province_id : $("#provinsi").val()},
				dataType: "json",
				beforeSend: function(e) {
			        if(e && e.overrideMimeType) {
			          e.overrideMimeType("application/json;charset=UTF-8");
			        }
			    },
			    success: function(response){
			    	$(".loader").hide();
			    	$('.selectpicker').selectpicker('show');
			    	$("#city").removeAttr('disabled');
			    	$.each(response,function(index,city){
			    		$('#city').append($('<option>', {
					        value: city.city_id ,
					        text:  city.type+' '+city.city_name
					    }));

                    });
                    $('.selectpicker').selectpicker('refresh');
			    	},
			      error: function (xhr, ajaxOptions, thrownError) {
			        alert(thrownError); 
			      }
    	});
    });
		@if(is_null($address))
		//Alamat Kosong
		$(document).on('click','#submit',function(){
			$('#myModal').modal('toggle');
			var jenis_alamat = $('#jenis_alamat').val();
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();
			var id_provinsi = $('#provinsi').val();
			var id_kota = $('#city').val();
			var alamat = $('#alamat').val();
			$.ajaxSetup({
			    headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
			$.ajax({
				type: "POST",
				url: "{{route('profile.store')}}",
				data: {jenis_alamat : jenis_alamat, nama : nama, telepon : telepon, id_provinsi : id_provinsi, id_kota : id_kota, alamat : alamat},
				dataType: "json",
			    success: function(response){
			    	$("#include").load(location.href + " #include");
			    	$('#alert').css("opacity", "");
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-success"><strong>'+response["message"][0]+'</strong></div>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			    	$('#order').removeAttr( "disabled");
		            $('#li-tab2').removeClass( "disabled");
		            $('#tab2').removeprop("disabled");
			    	},
			      error: function (response) {
			      	$('#alert').css("opacity", "");
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-danger"><strong>'+response.responseJSON["message"]+'</strong></div>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			      }
    		});
		});
		@endif
		@if(!is_null($address))
		//Update
		$(document).on('click','#submit',function(){
			var data  = $(this).data("id");
			var jenis_alamat = $('#jenis_alamat').val();
			var nama = $('#nama').val();
			var telepon = $('#telepon').val();
			var id_provinsi = $('#provinsi').val();
			var id_kota = $('#city').val();
			var alamat = $('#alamat').val();
			$.ajaxSetup({
			    headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
			$.ajax({
				type: "POST",
				url: "{{route('profile.update')}}",
				data: {id : data, jenis_alamat : jenis_alamat, nama : nama, telepon : telepon, id_provinsi : id_provinsi, id_kota : id_kota, alamat : alamat},
				dataType: "json",
				beforeSend: function(e) {
			        if(e && e.overrideMimeType) {
			          e.overrideMimeType("application/json;charset=UTF-8");
			        }
			    },
			    success: function(response){
			    	$("#include").load(location.href + " #include");
					$('.selectpicker').selectpicker('refresh');
			    	$('#jenis').empty();
			    	$('#an').empty();
			    	$('#telp').empty();
			    	$('#tipe_city').empty();
			    	$('#kota').empty();
			    	$('#provinsi_tb').empty();
			    	$('#full').empty();
			    	$('#myModal2').modal('toggle');
			    	$('#alert').css("opacity", "");
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-success"><strong>'+response["message"][0]+'</strong></div>');
			    	$('#jenis').html('<h4><strong>'+response["alamat"][0]["jenis_alamat"]+'</strong></h4>');
			    	$('#an').html('<h4><strong>'+response["alamat"][0]["nama"]+'</strong></h4>');
			    	$('#telp').html('<h4><strong>'+response["alamat"][0]["telepon"]+'</strong></h4>');
			    	$('#tipe_city').html('<h4>'+response["alamat"][0]["type"]+'</h4>');
			    	$('#kota').html('<h4><strong>'+response["alamat"][0]["city_name"]+'</strong></h4>');
			    	$('#provinsi_tb').html('<h4><strong>'+response["alamat"][0]["province"]+'</strong></h4>');
			    	$('#full_address').html('<h4><strong>'+response["alamat"][0]["alamat"]+'</strong></h4>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			    	},
			      error: function (response) {
			        $('#myModal2').modal('toggle');
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-danger"><strong>'+response["message"]+'</strong></div>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			      }
    		});
		});
		@endif
		@if(Auth::user()->level == "admin")
		$(document).on('click','#pilih',function(){
			$('#modal10').modal('toggle');
			var data  = $(this).data("id");
			$.ajaxSetup({
			    headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});
			$.ajax({
				type: "POST",
				url: "{{route('profile.activate')}}",
				data: {id : data},
				dataType: "json",
			    success: function(response){
			    	$("#include").load(location.href + " #include");
			    	$('#alert').css("opacity", "");
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-success"><strong>'+response["message"]+'</strong></div>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			    	},
			      error: function (response) {
			      	$('#alert').css("opacity", "");
			    	$('#alert').show();
			    	$('#alert').html('<div class="alert alert-danger"><strong>'+response.responseJSON["message"]+'</strong></div>');
			    	window.setTimeout(function() {
                        $('#alert').fadeTo(500, 0).slideUp(500, function(){
                        });
                    }, 4000); 
			      }
    		});
		});
		@endif
});
</script>
</div>
