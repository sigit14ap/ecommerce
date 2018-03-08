@extends('layouts.app')
@section('main-content')
@section('title', 'Ubah Produk')
<div class="container">
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

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Home</a>
                        </li>
                        <li>Ubah Produk</li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="box">
                        <h1>Ubah Produk</h1>
                        <hr>

                        <form role="form" action="{{ route('update',$barang->id_barang) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama Barang. . ." value="{{$barang->judul}}" required>
                                @if ($errors->has('judul'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('judul') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="selectpicker col-lg-12" data-show-subtext="true" data-live-search="true" name="id_kategori">
                                @foreach($kategori as $cat)
                                <option data-subtext="{{ $cat->bagian }}" value="{{ $cat->id }}" 
                                @if($cat->id == $barang->id_kategori)
                                selected
                                @endif 
                                >{{ $cat->nama_kat }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" rows="5" name="deskripsi" placeholder="Deskripsi Barang. . ." required>{{$barang->deskripsi}}</textarea>
                                @if ($errors->has('deskripsi'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('deskripsi') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="berat">Berat/Barang (gram)</label>
                                <input type="number" class="form-control" id="berat" name="berat" placeholder="Berat Barang. . ." value="{{$barang->berat}}" required>
                                @if ($errors->has('berat'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('stok') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok Barang</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang. . ." value="{{$barang->stok}}" required>
                                @if ($errors->has('stok'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('stok') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang. . ." value="{{$angka_format = number_format($barang->harga,0,",",".")}}" onkeyup="formatangka(this)" required>
                                </div>
                                @if ($errors->has('harga'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('harga') }}.
                                </div>
                                @endif
                            </div>
                        <div class="container">
                            <div class="form-group col-md-3 col-xs-6">
                                <label for="foto">Foto 1</label>
                                <div  style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);">
                                    <img id="uploadPreview" src="{{asset('img/uploads/'.$barang->foto1)}}" class="img-responsive" style="width: 255px;height: 255px;">
                                <input type="file" name="foto1" id="uploadImage" class="file" onchange="PreviewImage1();" style="display: none;">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" style="width: 101%;" type="button"><i class="fa fa-search" aria-hidden="true"></i> Ubah Foto</button>
                                </span>
                                </div>

                                @if ($errors->has('foto1'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto1') }}.
                                </div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 col-xs-6">
                                <label for="foto">Foto 2</label>
                                <div  style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);">
                                    <img id="uploadPreview2" src="{{asset('img/uploads/'.$barang->foto2)}}" class="img-responsive" style="width: 255px;height: 255px;">
                                <input type="file" name="foto2" id="uploadImage2" class="file" onchange="PreviewImage2();" style="display: none;">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" style="width: 101%;" type="button"><i class="fa fa-search" aria-hidden="true"></i> Ubah Foto</button>
                                </span>
                                </div>

                                @if ($errors->has('foto2'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto2') }}.
                                </div>
                                @endif
                            </div>

                            <div class="form-group col-md-3 col-xs-6">
                                <label for="foto">Foto 3</label>
                                <div  style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);">
                                    <img id="uploadPreview3" src="{{asset('img/uploads/'.$barang->foto3)}}" class="img-responsive" style="width: 255px;height: 255px;">
                                <input type="file" name="foto3" id="uploadImage3" class="file" onchange="PreviewImage3();" style="display: none;">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" style="width: 101%;" type="button"><i class="fa fa-search" aria-hidden="true"></i> Ubah Foto</button>
                                </span>
                                </div>

                                @if ($errors->has('foto3'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto3') }}.
                                </div>
                                @endif
                            </div>
                        </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o" aria-hidden="true"></i> Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        



<script type="text/javascript">
  $(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

$(document).ready(function(){
        $('#example').DataTable();
    });

function formatangka(objek) {
   a = objek.value;
   b = a.replace(/[^\d]/g,"");
   c = "";
   panjang = b.length;
   j = 0;
   for (i = panjang; i > 0; i--) {
     j = j + 1;
     if (((j % 3) == 1) && (j != 1)) {
       c = b.substr(i-1,1) + "." + c;
     } else {
       c = b.substr(i-1,1) + c;
     }
   }
   objek.value = c;
}
function PreviewImage1() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
  oFReader.onload = function (oFREvent)
   {
      document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
  };

function PreviewImage2() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("uploadImage2").files[0]);
  oFReader.onload = function (oFREvent)
   {
      document.getElementById("uploadPreview2").src = oFREvent.target.result;
    };
  };

function PreviewImage3() {
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("uploadImage3").files[0]);
  oFReader.onload = function (oFREvent)
   {
      document.getElementById("uploadPreview3").src = oFREvent.target.result;
    };
  };
</script>






  @endsection