@extends('layouts.app')
@section('main-content')
@section('title', 'Tambah Produk')
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
                        <li>Kelola Produk</li>
                        <li>Tambah Produk</li>
                    </ul>

                </div>

                <div class="col-md-12">
                    <div class="box">
                        <h1>Tambah Produk</h1>
                        <hr>

                        <form role="form" action="{{ route('store.barang') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama Barang. . ." required>
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
                                <option data-subtext="{{ $cat->bagian }}" value="{{ $cat->id }}">{{ $cat->nama_kat }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" rows="5" name="deskripsi" placeholder="Deskripsi Barang. . ." required></textarea>
                                @if ($errors->has('deskripsi'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('deskripsi') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="berat">Berat/Barang (gram)</label>
                                <input type="number" class="form-control" id="berat" name="berat" placeholder="Berat. . ." required>
                                @if ($errors->has('berat'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('berat') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok Barang</label>
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok Barang. . ." required>
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
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Barang. . ." onkeyup="formatangka(this)" required>
                                </div>
                                @if ($errors->has('harga'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('harga') }}.
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto1" class="file" style="display: none;">
                                <div class="input-group col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i> Browse</button>
                                </span>
                                </div>
                                @if ($errors->has('foto1'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto1') }}.
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="file" name="foto2" class="file" style="display: none;">
                                <div class="input-group col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i> Browse</button>
                                </span>
                                </div>
                                @if ($errors->has('foto2'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto2') }}.
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="file" name="foto3" class="file" style="display: none;">
                                <div class="input-group col-xs-12">
                                <span class="input-group-addon"><i class="fa fa-picture-o" aria-hidden="true"></i></span>
                                <input type="text" class="form-control input-lg" disabled placeholder="Upload Image">
                                <span class="input-group-btn">
                                <button class="browse btn btn-primary input-lg" type="button"><i class="fa fa-search" aria-hidden="true"></i> Browse</button>
                                </span>
                                </div>
                                @if ($errors->has('foto3'))
                                <div class="alert alert-danger">
                                <strong>Error!</strong> {{ $errors->first('foto3') }}.
                                </div>
                                @endif
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
</script>
@endsection